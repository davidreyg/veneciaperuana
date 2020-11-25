<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $products = [
            [
                'name' => 'GALLETAS OREO 35g',

                'category_id' => 2,

            ],
            [
                'name' => 'PULP x150 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'CORONA 500 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'ITAIPAVA 500 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'CUZQUEÑA 450 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'GUARANÁ 500 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'KOLA REAL 350 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'PILSEN 500 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'PILSEN 255 ml',

                'category_id' => 1,

            ],
            [
                'name' => 'GALLETA RELLENITAS 50g',

                'category_id' => 2,

            ],
            [
                'name' => 'GALLETA CLUB SOCIAL 30g',

                'category_id' => 2,

            ],
            [
                'name' => 'GALLETA SODA V 50g',

                'category_id' => 2,

            ],
            [
                'name' => 'GASEOSA INCA KOLA 2.5 L',

                'category_id' => 1,

            ],
            [
                'name' => 'COCA COLA 355 ml LATA',
                'category_id' => 1,

            ],
            [
                'name' => 'AGUA BRASILERA PEQUEÑA',
                'category_id' => 1,

            ],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
