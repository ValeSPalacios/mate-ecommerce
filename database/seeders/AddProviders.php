<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;

class AddProviders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
            'first_name'=>'Marito',
            'last_name'=>'Baracus',
            'dni'=>'39876123',
            'address'=>'Avenida Falsa 123',
            'mobile'=>'3794456723',
            'user_created'=>5,
            'user_updated'=>5
        ]);

        Provider::create([
            'first_name'=>'Jon',
            'last_name'=>'Snow',
            'dni'=>'50876136',
            'address'=>'Avenida Falsa 321',
            'mobile'=>'3794465732',
            'user_created'=>5,
            'user_updated'=>5
        ]);

        Provider::create([
            'first_name'=>'Bart',
            'last_name'=>'Simpson',
            'dni'=>'52678123',
            'address'=>'Avenida Falsa 666',
            'mobile'=>'3794466889',
            'user_created'=>5,
            'user_updated'=>5
        ]);

    }
}
