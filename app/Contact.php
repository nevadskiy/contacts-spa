<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property Carbon birthday
 * @property string company
 * @property Carbon updated_at
 */
class Contact extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birthday',
    ];

    /**
     * The birthday mutator.
     *
     * @param string $birthday
     */
    public function setBirthdayAttribute(string $birthday): void
    {
        $this->attributes['birthday'] = Carbon::parse($birthday);
    }
}
