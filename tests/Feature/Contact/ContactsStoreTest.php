<?php

namespace Tests\Feature\Contact;

use App\Contact;
use DateTimeInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Http\Response;
use Tests\TestCase;

class ContactsStoreTest extends TestCase
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

    /** @test */
    public function a_birthday_is_required(): void
    {
        $response = $this->storeContact([
            'birthday' => '',
        ]);

        $response->assertJsonValidationErrors(['birthday']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function a_birthday_must_be_a_valid_date(): void
    {
        $response = $this->storeContact([
            'birthday' => 'INVALID DATE',
        ]);

        $response->assertJsonValidationErrors(['birthday']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function a_company_is_required(): void
    {
        $response = $this->storeContact([
            'company' => '',
        ]);

        $response->assertJsonValidationErrors(['company']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function an_email_must_be_a_valid_email(): void
    {
        $response = $this->storeContact([
            'email' => 'invalid email',
        ]);

        $response->assertJsonValidationErrors(['email']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function birthdays_are_properly_stored(): void
    {
        $this->storeContact([
            'birthday' => '05/14/1990',
        ]);

        $contact = Contact::first();

        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(DateTimeInterface::class, $contact->birthday);
        $this->assertEquals('05-14-1990', $contact->birthday->format('m-d-Y'));
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
