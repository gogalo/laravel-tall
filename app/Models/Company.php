<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'created_by', 'updated_by'
    ];

    /**
     * This is model Observer which helps to do the same actions automatically when you creating or updating models
     */
    protected static function boot()
    {
        parent::boot();

        // when create
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        // when update
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

}
