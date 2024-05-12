<?php

namespace Database\Seeders;

use App\Models\ProductProvider;
use Illuminate\Database\Seeder;

class AddProvidersProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Nota. Controlar que los id de producto y proveedores existan en 
         * la base de datos.
         */
        ProductProvider::create([
            'product_id'=>1,
            'provider_id'=>1
        ]);
        ProductProvider::create([
            'product_id'=>2,
            'provider_id'=>1
        ]);
        ProductProvider::create([
            'product_id'=>3,
            'provider_id'=>2
        ]);
        ProductProvider::create([
            'product_id'=>4,
            'provider_id'=>2
        ]);
        ProductProvider::create([
            'product_id'=>5,
            'provider_id'=>3
        ]);
        ProductProvider::create([
            'product_id'=>6,
            'provider_id'=>3
        ]);
        ProductProvider::create([
            'product_id'=>7,
            'provider_id'=>2
        ]);
        ProductProvider::create([
            'product_id'=>8,
            'provider_id'=>1
        ]);
        ProductProvider::create([
            'product_id'=>9,
            'provider_id'=>3
        ]);
        ProductProvider::create([
            'product_id'=>10,
            'provider_id'=>1
        ]);
        ProductProvider::create([
            'product_id'=>11,
            'provider_id'=>2
        ]);
    }
}
