<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_number',
        'quotation_name',
        'gst_number',
        'client_name',
        'client_place',
        'client_contact',
        'event_venue',
        'event_name',
        'event_date',
        'event_time',
        'decor_type',
        'stage_amount',
        'seat_amount',
        'table_amount',
        'number_of_tables',
        'number_of_people',
        'number_of_seats',
        'per_plate_price',
        'total_amount'
    ];

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'quotation_items');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            $quotation->quotation_number = 'QTN-' . date('Ymd') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}