<?php

namespace Tests\Feature\Contact;

use App\Contact;
use App\User;
use Tests\ApiTestCase;

class ContactsShowTest extends ApiTestCase
{
    /** @test */
    public function contacts_can_be_retrieved_by_owners(): void
    {
        $contact = factory(Contact::class)->create();

        $response = $this->signIn($contact->user)->getJson("/api/contacts/{$contact->id}");

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $contact->id,
                'name' => $contact->name,
                'birthday' => $contact->birthday->format('m/d/Y'),
                'company' => $contact->company,
                'last_updated' => $contact->updated_at->diffForHumans(),
            ],
        ]);
    }

    /** @test */
    public function contacts_cannot_be_retrieved_by_another_users(): void
    {
        $contact = factory(Contact::class)->create();

        $response = $this->signIn()->getJson("/api/contacts/{$contact->id}");

        $response->assertForbidden();
    }
}
