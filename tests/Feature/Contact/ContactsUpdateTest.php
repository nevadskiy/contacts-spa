<?php

namespace Tests\Feature\Contact;

use App\Contact;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\ApiTestCase;

class ContactsUpdateTest extends ApiTestCase
{
    /** @test */
    public function guests_cannot_update_contacts(): void
    {
        $contact = factory(Contact::class)->create([
            'email' => 'old@mail.com',
        ]);

        $response = $this->updateContact($contact, [
            'email' => 'new@mail.com',
        ]);

        $response->assertUnauthorized();
        $this->assertEquals('old@mail.com', $contact->fresh()->email);
    }

    /** @test */
    public function contacts_can_be_updated_by_users(): void
    {
        $contact = factory(Contact::class)->create([
            'name' => 'Old name',
            'email' => 'old@mail.com',
            'birthday' => '05/14/1990',
            'company' => 'OLD Company',
        ]);

        $response = $this->signIn()->putJson("/api/contacts/{$contact->id}", [
            'name' => 'New name',
            'email' => 'new@mail.com',
            'birthday' => '05/14/2000',
            'company' => 'NEW Company',
        ]);

        $contact = $contact->fresh();

        $response->assertOk();

        $this->assertEquals('New name', $contact->name);
        $this->assertEquals('new@mail.com', $contact->email);
        $this->assertEquals('05/14/2000', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('NEW Company', $contact->company);
    }

    /** @test */
    public function a_name_is_required_for_updating_contacts(): void
    {
        $contact = factory(Contact::class)->create([
            'name' => 'Old name',
        ]);

        $response = $this->signIn()->updateContact($contact, [
            'name' => '',
        ]);

        $response->assertJsonValidationErrors(['name']);
        $this->assertEquals('Old name', $contact->fresh()->name);
    }

    /** @test */
    public function an_email_is_required_for_updating_contacts(): void
    {
        $contact = factory(Contact::class)->create([
            'email' => 'old@mail.com',
        ]);

        $response = $this->signIn()->updateContact($contact, [
            'email' => '',
        ]);

        $response->assertJsonValidationErrors(['email']);
        $this->assertEquals('old@mail.com', $contact->fresh()->email);
    }

    /** @test */
    public function an_email_must_be_a_valid_email_for_updating_contacts(): void
    {
        $contact = factory(Contact::class)->create([
            'email' => 'old@mail.com',
        ]);

        $response = $this->signIn()->updateContact($contact, [
            'email' => 'INVALID EMAIL',
        ]);

        $response->assertJsonValidationErrors(['email']);
        $this->assertEquals('old@mail.com', $contact->fresh()->email);
    }

    /** @test */
    public function a_birthday_is_required_for_updating_contacts(): void
    {
        $contact = factory(Contact::class)->create([
            'birthday' => '05/14/1990',
        ]);

        $response = $this->signIn()->updateContact($contact, [
            'birthday' => '',
        ]);

        $response->assertJsonValidationErrors(['birthday']);
        $this->assertEquals('05/14/1990', $contact->fresh()->birthday->format('m/d/Y'));
    }

    /** @test */
    public function a_birthday_must_be_a_valid_date_for_updating_contacts(): void
    {
        $contact = factory(Contact::class)->create([
            'birthday' => '05/14/1990',
        ]);

        $response = $this->signIn()->updateContact($contact, [
            'birthday' => 'INVALID DATE',
        ]);

        $response->assertJsonValidationErrors(['birthday']);
        $this->assertEquals('05/14/1990', $contact->fresh()->birthday->format('m/d/Y'));
    }

    /** @test */
    public function a_company_is_required_for_updating_contacts(): void
    {
        $contact = factory(Contact::class)->create([
            'company' => 'Old company',
        ]);

        $response = $this->signIn()->updateContact($contact, [
            'company' => '',
        ]);

        $response->assertJsonValidationErrors(['company']);
        $this->assertEquals('Old company', $contact->fresh()->company);
    }

    private function updateContact(Contact $contact, array $overrides = []): TestResponse
    {
        return $this->putJson("/api/contacts/{$contact->id}", array_merge([
            'name' => 'New name',
            'email' => 'new@mail.com',
            'birthday' => '05/14/2000',
            'company' => 'NEW Company',
        ], $overrides));
    }
}
