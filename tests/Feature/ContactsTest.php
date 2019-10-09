<?php

namespace Tests\Feature;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
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

    /** @test */
    public function a_name_is_required(): void
    {
        $response = $this->storeContact([
            'name' => '',
        ]);

        $response->assertJsonValidationErrors(['name']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function email_is_required(): void
    {
        $response = $this->storeContact([
            'email' => '',
        ]);

        $response->assertJsonValidationErrors(['email']);
        $this->assertEmpty(Contact::all());
    }

    private function storeContact(array $overrides = []): TestResponse
    {
        return $this->postJson('/api/contacts', array_merge([
            'name' => 'Test contact',
            'email' => 'test@mail.com',
            'birthday' => '05/14/1990',
            'company' => 'ABC Company',
        ], $overrides));
    }
}
