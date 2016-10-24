<?php

class SettingsImportSeeder extends ImportSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->import('settings');
    }
}
