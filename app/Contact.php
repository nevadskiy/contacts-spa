<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property Carbon birthday
 * @property string company
 * @property Carbon updated_at
 * @property User user
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

    /**
     * User relation.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope by birthday contacts.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeBirthdays(Builder $query): Builder
    {
        return $query->whereMonth('birthday', now());
    }
}
