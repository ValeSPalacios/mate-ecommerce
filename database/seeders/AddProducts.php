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
            'name'=>'Producto X',
            'description'=>'Producto nueva prueba 1',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>1500,
            'increase'=>3,
            'stock'=>500,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
        Product::create([
            'name'=>'Producto Y',
            'description'=>'Producto nuevo de prueba Y',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>1500,
            'increase'=>2,
            'stock'=>250,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
        Product::create([
            'name'=>'Producto Z',
            'description'=>'Producto siempre de prueba Z',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>2000,
            'increase'=>3,
            'stock'=>350,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
        Product::create([
            'name'=>'Producto XZ',
            'description'=>'Producto prueba ZX nuevo',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>1700,
            'increase'=>3,
            'stock'=>450,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
        Product::create([
            'name'=>'Producto Nuvo WZ',
            'description'=>'Producto prueba WZ',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>3100,
            'increase'=>1,
            'stock'=>720,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
        Product::create([
            'name'=>'Producto Super Nuevo ZX',
            'description'=>'Producto con un comentario super nuevo ZX',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>3722,
            'increase'=>3,
            'stock'=>80,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
        Product::create([
            'name'=>'Producto Simple',
            'description'=>'Producto nuevo simple por siempre',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>12000,
            'increase'=>2,
            'stock'=>430,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
        Product::create([
            'name'=>'Producto WWF',
            'description'=>'Producto prueba WWF',
            'product_image'=>'image/product/mate1.jpeg',
            'cost_price'=>2450,
            'increase'=>2,
            'stock'=>507,
            'category_id'=>1,
            'user_created'=>6,
            'user_updated'=>6
        ]);
    }
}
