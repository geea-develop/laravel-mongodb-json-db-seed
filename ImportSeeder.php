<?php

/**
 * Created by PhpStorm.
 * User: gee
 * Date: 24/10/16
 * Time: 12:40
 */

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImportSeeder
 */
class ImportSeeder extends Seeder
{
    /**
     * @var
     */
    private $fileName;

    /**
     * @var
     */
    private $collectionName;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    }

    public function import($collection)
    {
        $this->fileName = $collection.'.json';
        $this->collectionName = $collection;

        $local = Storage::disk('import');

        $file = $local->get($this->fileName);

        $content = json_decode($file, true);

        if (count($content) > 0) {
            $this->doImport($content);
        } else {
            error_log('Missing content in file for '. $collection.'. Nothing was imported ');
        }
    }

    private function doImport($content)
    {
        $content = $this->bulkModify($content);

        DB::connection('mongodb')->table($this->collectionName)->insert($content);
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getCollectionName()
    {
        return $this->collectionName;
    }

    /**
     * @param mixed $collectionName
     */
    public function setCollectionName($collectionName)
    {
        $this->collectionName = $collectionName;
    }

    private function modifyObjectId($id)
    {
        return new \MongoDB\BSON\ObjectID($id);
    }

    private function modifyDate($date)
    {
        return new MongoDB\BSON\UTCDateTime(strtotime($date)*1000);
    }


    private function bulkModify($content)
    {
        foreach ($content as $key => $value)
        {
            if (isset($value['_id']))
                $value['_id'] = $this->modifyObjectId($value['_id']);
            if (isset($value['created_at']))
                $value['created_at'] = $this->modifyDate($value['created_at']);
            if (isset($value['updated_at']))
                $value['updated_at'] = $this->modifyDate($value['updated_at']);

            $content[$key] = $value;
        }

        return $content;
    }

}