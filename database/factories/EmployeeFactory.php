<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;
use Faker\Provider\es_PE\Person;

$factory->define(Employee::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));;
    return [
        'name' => $faker->firstName,
        'alias' => $faker->domainName,
        'phone' => $faker->randomNumber($nbDigits = 9)
    ];
});
