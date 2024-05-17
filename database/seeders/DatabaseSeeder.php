<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //Comando para ejecutar un seeder en particular 
    //php artisan db:seed --class=NombreSeeder
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User en el orden mostrado para evtiar errores
        // \App\Models\User::factory(10)->create();
       // $this->call(AddRolePermission::class);
        //$this->call(AddCategories::class);
        //$this->call(AddProducts::class);
        //$this->call(AddProviders::class);
        ////$this->call(AddProviderProduct::class);
    }
}
