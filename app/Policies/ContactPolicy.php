<?php

namespace App\Policies;

use App\Contact;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the contact.
     *
     * @param User $user
     * @param Contact $contact
     * @return bool
     */
    public function view(User $user, Contact $contact): bool
    {
        return $this->touch($user, $contact);
    }

    /**
     * Determine whether the user can update the contact.
     *
     * @param User $user
     * @param Contact $contact
     * @return bool
     */
    public function update(User $user, Contact $contact): bool
    {
        return $this->touch($user, $contact);
    }

    /**
     * Determine whether the user can delete the contact.
     *
     * @param User $user
     * @param Contact $contact
     * @return bool
     */
    public function delete(User $user, Contact $contact): bool
    {
        return $this->touch($user, $contact);
    }

    /**
     * Determine whether the user can touch the contact.
     *
     * @param User $user
     * @param Contact $contact
     * @return bool
     */
    private function touch(User $user, Contact $contact): bool
    {
        return $contact->user->is($user);
    }
}
