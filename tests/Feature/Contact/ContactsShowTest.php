<?php

namespace Tests\Feature\Contact;

use App\Contact;
use Tests\ApiTestCase;

class ContactsShowTest extends ApiTestCase
{
    /** @test */
    public function contacts_can_be_retrieved(): void
    {
        $contact = factory(Contact::class)->create();

        $response = $this->signIn()->getJson("/api/contacts/{$contact->id}");

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
}
