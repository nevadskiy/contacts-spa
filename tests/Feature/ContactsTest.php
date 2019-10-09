<?php

namespace Tests\Feature;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_contact_can_be_added(): void
    {
        $response = $this->postJson('/api/contacts', [
            'name' => 'Test contact',
            'email' => 'test@mail.com',
            'birthday' => '05/14/1990',
            'company' => 'ABC Company',
        ]);

        $contact = Contact::first();

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertCount(1, Contact::all());
        $this->assertEquals('Test contact', $contact->name);
        $this->assertEquals('test@mail.com', $contact->email);
        $this->assertEquals('05/14/1990', $contact->birthday);
        $this->assertEquals('ABC Company', $contact->company);
    }
}
