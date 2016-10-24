<?php

class CurrencyImportSeeder extends ImportSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->import('currency');
    }
}
