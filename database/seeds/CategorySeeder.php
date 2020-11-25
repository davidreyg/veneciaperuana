<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tipos = [
            [
                'name' => 'MENÚ',

            ],
            [
                'name' => 'ALMUERZO',

            ],
            [
                'name' => 'PLATO A LA CARTA',

            ],
            [
                'name' => 'BEBIDAS',
            ],
        ];
        foreach ($tipos as $tipo) {
            Category::create($tipo);
        }
    }
}
