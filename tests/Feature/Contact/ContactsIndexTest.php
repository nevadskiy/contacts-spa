<?php

namespace Tests\Feature\Contact;

use App\Contact;
use App\User;
use Tests\ApiTestCase;

class ContactsIndexTest extends ApiTestCase
{
    /** @test */
    public function contacts_list_can_be_fetched_by_owners(): void
    {
        $user = factory(User::class)->create();

        [$contact1, $contact2, $contact3] = factory(Contact::class, 3)->create(['user_id' => $user->id]);

        $response = $this->signIn($user)->getJson('/api/contacts');

        $response->assertOk();
        $response->assertJsonFragment(['id' => $contact1->id]);
        $response->assertJsonFragment(['id' => $contact2->id]);
        $response->assertJsonFragment(['id' => $contact3->id]);
        $response->assertJsonStructure(['data' => [
            '*' => [
                'data' => ['id', 'name', 'birthday', 'company', 'last_updated'],
                'links' => ['self']
            ]
        ]]);
    }
}
