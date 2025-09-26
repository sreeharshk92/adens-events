<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sort_order', 'is_active'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function activeMenuItems()
    {
        return $this->hasMany(MenuItem::class)->where('is_active', true);
    }

    // Add this scope for active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}