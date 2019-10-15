<?php

namespace App\Http\Resources;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Contact contact
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
                'id' => $this->resource->id,
                'name' => $this->resource->name,
                'birthday' => $this->resource->birthday->format('m/d/Y'),
                'company' => $this->resource->company,
                'last_updated' => $this->resource->updated_at->diffForHumans(),
            ],
            'links' => [
                'self' => route('contacts.show', $this->resource),
            ],
        ];
    }
}
