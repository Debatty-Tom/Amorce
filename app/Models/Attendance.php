<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'status',
        'donator_id',
        'draw_id',
        'contact',
    ];
    public function draw(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Draw::class);
    }
    public function donator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Donator::class);
    }

    public function getdonatorContact(): string
    {
        if($this->donator()->email === null) {
            if ($this->donator()->phone === null) {
                return $this->donator()->address;
            } else {
                return $this->donator()->phone;
            }
        }
        return $this->donator()->email;
    }

    protected function contactData():Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $this->getdonatorContact(),
        );
    }
}
