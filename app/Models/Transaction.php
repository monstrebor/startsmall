<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
        protected $fillable = [
        'sale_id',
        'type',
        'source',
        'amount',
        'reference_no',
        'tin',
        'remarks',
        'created_by',
    ];
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public static function generateReferenceNo()
    {
        $prefix = 'RCP-' . now()->format('Ymd') . '-';
        $last = self::whereDate('created_at', today())->count() + 1;
        return $prefix . str_pad($last, 4, '0', STR_PAD_LEFT);
    }
}
