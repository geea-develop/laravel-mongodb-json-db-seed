<?php

use Illuminate\Database\Seeder;
use Jenssegers\Mongodb\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(CountriesImportSeeder::class);
        $this->call(CurrencyImportSeeder::class);
        $this->call(LanguagesImportSeeder::class);
        $this->call(SettingsImportSeeder::class);
        $this->call(TermsImportSeeder::class);

        Model::reguard();
    }
}
