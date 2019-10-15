<?php

namespace Tests\Feature\Contact;

use App\Contact;
use Tests\ApiTestCase;

class ContactsDeleteTest extends ApiTestCase
{
    /** @test */
    public function contacts_can_be_removed_by_owners(): void
    {
        $contact = factory(Contact::class)->create();

        $response = $this->signIn($contact->user)->deleteJson("/api/contacts/{$contact->id}");

        $response->assertNoContent();
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function contacts_cannot_be_removed_by_another_users(): void
    {
        $contact = factory(Contact::class)->create();

        $response = $this->signIn()->deleteJson("/api/contacts/{$contact->id}");

        $response->assertForbidden();
        $this->assertCount(1, Contact::all());
    }

    /** @test */
    public function guests_cannot_remove_contacts(): void
    {
        $contact = factory(Contact::class)->create();

        $response = $this->deleteJson("/api/contacts/{$contact->id}");

        $response->assertUnauthorized();
        $this->assertCount(1, Contact::all());
    }
}
