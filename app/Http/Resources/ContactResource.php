<?php

namespace App\Http\Resources;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Contact
 */
class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'birthday' => $this->birthday->format('m/d/Y'),
                'company' => $this->company,
                'last_updated' => $this->updated_at->diffForHumans(),
            ],
            'links' => [
                'self' => route('contacts.show', $this->resource),
            ],
        ];
    }
}
