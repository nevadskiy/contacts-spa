<?php

/** @var Factory $factory */

use App\Contact;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => 'Test contact',
        'email' => 'test@mail.com',
        'birthday' => '05/14/1990',
        'company' => 'ABC Company',
        'user_id' => function () {
            return \factory(User::class)->create()->id;
        }
    ];
});
