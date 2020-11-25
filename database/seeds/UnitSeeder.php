<?php

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create(['name' => 'caja', 'description' => 'Caja de productos', 'company_id' => 1]);
        Unit::create(['name' => 'paca', 'description' => 'Paca de cerveza.', 'company_id' => 1]);
        Unit::create(['name' => 'bolsa', 'description' => 'Bombones, caramelos', 'company_id' => 1]);
        // Unit::create(['name' => '', 'description' => 'Caja de productos', 'company_id' => 1]);
        Unit::create(['name' => 'g', 'description' => 'Gramos de ajinomoto, panquita', 'company_id' => 1]);
        // Unit::create(['name' => 'in', 'company_id' => 1]);
        Unit::create(['name' => 'Kg', 'description' => 'Kilgramos de papa, arroz, azucar', 'company_id' => 1]);
        // Unit::create(['name' => 'km', 'company_id' => 1]);
        Unit::create(['name' => 'Lt', 'description' => 'Leche, aceite, vinagre', 'company_id' => 1]);
        // Unit::create(['name' => 'mg', 'company_id' => 1]);
        // Unit::create(['name' => 'pc', 'company_id' => 1]);
    }
}
