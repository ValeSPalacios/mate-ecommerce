<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class AddProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       /* Product::create([
            'name'=>'Producto 1',
            'description'=>'Producto prueba 1',
            'product_image'=>'imagen/product/mate1.jpeg',
            'cost_price'=>1000,
            'increase'=>1,
            'stock'=>50,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);

        Product::create([
            'name'=>'Producto 2',
            'description'=>'Producto prueba 2',
            'product_image'=>'imagen/product/prod1.png',
            'cost_price'=>1500,
            'increase'=>3,
            'stock'=>85,
            'category_id'=>2,
            'user_created'=>6,
            'user_updated'=>6
        ]);

        Product::create([
            'name'=>'Producto 3',
            'description'=>'Producto prueba 3',
            'product_image'=>'imagen/product/setMatero2.jpeg',
            'cost_price'=>5000,
            'increase'=>4,
            'stock'=>500,
            'category_id'=>3,
            'user_created'=>6,
            'user_updated'=>6
        ]);*/

        Product::create([
            'name'=>'Mate Uruguayo Virola Acero',
            'description'=>'Mate de calabaza uruguayo,
                con virola de acero (ideal para grabar) forrado en cuero y base reforzada.',
            'product_image'=>'image/product/uruguayo.webp',
            'cost_price'=>1500,
            'increase'=>3,
            'stock'=>500,
            'category_id'=>1,
            'user_created'=>1,
            'user_updated'=>1
        ]);
        Product::create([
            'name'=>'Mate Super Imperial de Alpaca',
            'description'=>'Mate Super Imperial de calabaza forrado en cuero con virola,
                fleje y base de alpaca.',
            'product_image'=>'image/product/imperial-alpaca.webp',
            'cost_price'=>1500,
            'increase'=>2,
            'stock'=>250,
            'category_id'=>1,
            'user_created'=>1,
            'user_updated'=>1
        ]);
        Product::create([
            'name'=>'Mate Palo Santo Base',
            'description'=>'Mate de Madera Palo Santo pulido y Lustrado con Base de aluminio. 
                La madera de palo tiene un sabor y aroma',
            'product_image'=>'image/product/palo-santo.webp',
            'cost_price'=>1700,
            'increase'=>3,
            'stock'=>450,
            'category_id'=>1,
            'user_created'=>1,
            'user_updated'=>1
        ]);
        Product::create([
            'name'=>'Mate Imperial Pvc Calabaza',
            'description'=>'Mate Imperial de Calabaza seleccionada,
                revestido de PVC alto impacto imitación cuero. Con virola de Aluminio labrado.',
            'product_image'=>'image/product/imperpial-pvc.webp',
            'cost_price'=>3100,
            'increase'=>1,
            'stock'=>720,
            'category_id'=>1,
            'user_created'=>1,
            'user_updated'=>1
        ]);
        Product::create([
            'name'=>'Mate Brasilero',
            'description'=>'Mate de calabaza brasilera forrado en PVC',
            'product_image'=>'image/product/brasilero.webp',
            'cost_price'=>3722,
            'increase'=>3,
            'stock'=>80,
            'category_id'=>1,
            'user_created'=>1,
            'user_updated'=>1
        ]);
        Product::create([
            'name'=>'Mate y termo 1L',
            'description'=>'Termo de acero 1lt forrado + Mate de madera calden. Ambos Forrados',
            'product_image'=>'image/product/termo-mate-1.webp',
            'cost_price'=>12000,
            'increase'=>2,
            'stock'=>430,
            'category_id'=>2,
            'user_created'=>1,
            'user_updated'=>1
        ]);
        Product::create([
            'name'=>'Mate y Termo de 1L',
            'description'=>'Termo de acero 1lt forrado + Mate de madera calden. Ambos Forrados',
            'product_image'=>'image/product/termo-mate-2.webp',
            'cost_price'=>12000,
            'increase'=>2,
            'stock'=>430,
            'category_id'=>2,
            'user_created'=>1,
            'user_updated'=>1
        ]);
        Product::create([
            'name'=>'Mate y Termo - 1L',
            'description'=>'Termo de acero 1lt forrado + Mate de madera calden',
            'product_image'=>'image/product/termo-mate-3.webp',
            'cost_price'=>2450,
            'increase'=>2,
            'stock'=>507,
            'category_id'=>2,
            'user_created'=>1,
            'user_updated'=>1
        ]);
    }
}
