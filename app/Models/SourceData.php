<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = 'source_data';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'created_at',
    ];
}
