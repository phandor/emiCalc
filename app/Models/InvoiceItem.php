<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'positon',
        'facility',
        'transport_type',
        'transport_name',
        'distance_km',
        'emission'
    ];
}