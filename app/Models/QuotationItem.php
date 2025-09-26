<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;

    protected $fillable = ['quotation_id', 'menu_item_id'];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}