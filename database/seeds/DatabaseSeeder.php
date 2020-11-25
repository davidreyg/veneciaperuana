<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmployeeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        // $this->call(EstimateTemplateSeeder::class);
        $this->call(InvoiceTemplateSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(DishSeeder::class);
        $this->call(IngredientSeeder::class);
    }
}
