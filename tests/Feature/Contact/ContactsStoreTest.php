<?php

namespace Tests\Feature\Contact;

use App\Contact;
use App\User;
use DateTimeInterface;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Http\Response;
use Tests\ApiTestCase;

class ContactsStoreTest extends ApiTestCase
{
    /** @test */
    public function guests_cannot_store_contacts(): void
    {
        $response = $this->storeContact();

        $response->assertUnauthorized();
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function a_contact_can_be_added_by_users(): void
    {
        $user = factory(User::class)->create();

        $this->signIn($user);

        $response = $this->postJson('/api/contacts', [
            'name' => 'Test contact',
            'email' => 'test@mail.com',
            'birthday' => '05/14/1990',
            'company' => 'ABC Company',
        ]);

        $contact = Contact::first();

        $this->assertCount(1, Contact::all());
        $this->assertEquals('Test contact', $contact->name);
        $this->assertEquals('test@mail.com', $contact->email);
        $this->assertEquals('05/14/1990', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('ABC Company', $contact->company);
        $this->assertTrue($contact->user->is($user));

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'data' => ['id' => $contact->id],
            'links' => ['self' => url("/api/contacts/{$contact->id}")]
        ]);
    }

    /** @test */
    public function a_name_is_required(): void
    {
        $response = $this->signIn()->storeContact([
            'name' => '',
        ]);

        $response->assertJsonValidationErrors(['name']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function email_is_required(): void
    {
        $response = $this->signIn()->storeContact([
            'email' => '',
        ]);

        $response->assertJsonValidationErrors(['email']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function a_birthday_is_required(): void
    {
        $response = $this->signIn()->storeContact([
            'birthday' => '',
        ]);

        $response->assertJsonValidationErrors(['birthday']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function a_birthday_must_be_a_valid_date(): void
    {
        $response = $this->signIn()->storeContact([
            'birthday' => 'INVALID DATE',
        ]);

        $response->assertJsonValidationErrors(['birthday']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function a_company_is_required(): void
    {
        $response = $this->signIn()->storeContact([
            'company' => '',
        ]);

        $response->assertJsonValidationErrors(['company']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function an_email_must_be_a_valid_email(): void
    {
        $response = $this->signIn()->storeContact([
            'email' => 'invalid email',
        ]);

        $response->assertJsonValidationErrors(['email']);
        $this->assertEmpty(Contact::all());
    }

    /** @test */
    public function birthdays_are_properly_stored(): void
    {
        $this->signIn()->storeContact([
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
