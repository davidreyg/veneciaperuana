<?php

use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = [
            [
                'name' => 'AJI DE GALLINA',

                'price' => 10 * 100,

            ],
            [
                'name' => 'POLLO A LA OLLA',

                'price' => 10 * 100,

            ],
            [
                'name' => 'SUDADO DE PALOMETA',

                'price' => 10 * 100,

            ],
            [
                'name' => 'POLLO A LA NORTEÑA',

                'price' => 10 * 100,

            ],
            [
                'name' => 'ARROZ CON POLLO',

                'price' => 10 * 100,

            ],
            [
                'name' => 'PICADILLO DE PAICHE',

                'price' => 10 * 100,

            ],
            [
                'name' => 'OLLUQUITO CON CECINA',

                'price' => 10 * 100,

            ],
            [
                'name' => 'PICANTE DE CORAZÓN',

                'price' => 10 * 100,

            ],
            [
                'name' => 'POLLO A LA OLLA CON PURÉ DE PAPAS',

                'price' => 10 * 100,

            ],
            [
                'name' => 'CHICHARRÓN DE PAICHE',

                'price' => 10 * 100,

            ],
            [
                'name' => 'CHICHARRÓN DE POLLO',

                'price' => 25 * 100,

            ],
            [
                'name' => 'CEVICHE SIMPLE',

                'price' => 25 * 100,

            ],
            [
                'name' => 'CEVICHE MIXTO',

                'price' => 50 * 100,

            ],
            [
                'name' => 'LOMO SALTADO',

                'price' => 50 * 100,

            ],
            [
                'name' => 'CHAUFA ESPECIAL',

                'price' => 50 * 100,

            ],
            [
                'name' => 'GASEOSA INCA KOLA GRANDE',

                'price' => 30 * 100,

            ],
            [
                'name' => 'COCA COLA LATA',
                'price' => 30 * 100,

            ],
            [
                'name' => 'AGUA BRASILERA PEQUEÑA',
                'price' => 30 * 100,

            ],
        ];
        foreach ($dishes as $dish) {
            Dish::create($dish);
        }
    }
}
