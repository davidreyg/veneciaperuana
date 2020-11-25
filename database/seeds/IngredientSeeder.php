<?php

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            [
                'name' => 'PAPA BLANCA',

                'price' => 5 * 100,

            ],
            [
                'name' => 'TOMATE',

                'price' => 10 * 100,

            ],
            [
                'name' => 'CEBOLLA',

                'price' => 10 * 100,

            ],
            [
                'name' => 'ACEITE',

                'price' => 10 * 100,

            ],
            [
                'name' => 'ARROZ ALEMAO',

                'price' => 10 * 100,

            ],
            [
                'name' => 'VINAGRE BLANCO',

                'price' => 10 * 100,

            ],
            [
                'name' => 'SILLAO GRANDE',

                'price' => 10 * 100,

            ],
            [
                'name' => 'HUEVOS POR PACA',

                'price' => 10 * 100,

            ],
            [
                'name' => 'AJINOMOTO GRANDE',

                'price' => 6 * 100,

            ],
            [
                'name' => 'PIMIENTO BRASILERO',

                'price' => 5 * 100,

            ],
            [
                'name' => 'SAL CHICA',

                'price' => 8 * 100,

            ],
            [
                'name' => 'AZUCAR 1KG',

                'price' => 10 * 100,

            ],
            [
                'name' => 'LIMON X KILO',

                'price' => 75 * 100,

            ],
            [
                'name' => 'CAMOTE X KILO',
                'price' => 75 * 100,

            ],
            [
                'name' => 'OLLUCO X KILO',
                'price' => 75 * 100,

            ],
        ];
        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
