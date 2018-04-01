<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'date',
    ];

    protected $dates = [
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function setDateAttribute($value)
    {
        if (empty($value)) {
            $datetime = $value;
        } elseif (is_string($value) && preg_match('~^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$~', $value)) {
            $datetime = Carbon::createFromFormat('Y-m-d H:i', $value)->format($this->getDateFormat());
        } else {
            $datetime = $this->asDateTime($value)->format($this->getDateFormat());
        }

        $this->attributes['date'] = $datetime;
    }
}
