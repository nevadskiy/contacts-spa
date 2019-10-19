<?php

namespace Tests\Feature;

use App\Contact;
use App\User;
use Tests\ApiTestCase;

class BirthdaysIndexTest extends ApiTestCase
{
    /** @test */
    public function contacts_with_birthdays_in_the_current_month_can_be_fetched(): void
    {
        $user = factory(User::class)->create();

        $this->signIn($user);

        $contactWithBirthday = factory(Contact::class)->create([
            'user_id' => $user->id,
            'birthday' => now()->subYear(),
        ]);

        $anotherContact = factory(Contact::class)->create([
            'user_id' => $user->id,
            'birthday' => now()->subMonth(),
        ]);

        $response = $this->getJson('/api/birthdays');

        $response->assertJsonCount(1);

        $response->assertJson([
            'data' => [
                [
                    'data' => [
                        'id' => $contactWithBirthday->id,
                    ]
                ]
            ]
        ]);

        $response->assertJsonMissing(['id' => $anotherContact->id,]);
    }
}
