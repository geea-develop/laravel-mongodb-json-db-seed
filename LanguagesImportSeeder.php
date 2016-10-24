<?php

class LanguagesImportSeeder extends ImportSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->import('languages');
    }
}
