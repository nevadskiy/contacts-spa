<?php

namespace Tests\Feature\Contact;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ContactsDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contacts_can_be_removed(): void
    {
        $contact = factory(Contact::class)->create();

        $response = $this->deleteJson("/api/contacts/{$contact->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertEmpty(Contact::all());
    }
}
