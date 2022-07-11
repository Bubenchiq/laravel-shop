<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Order
 * @property string $status
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'total_price',
        'description',
        'user_id',
        'phone',
        'email',
        'manager_id',
        'considered_at',
        'status'

    ];

    const STATUS_APPROVED = 'approved',
        STATUS_REJECTED = 'rejected',
        STATUS_CONSIDERATION = 'consideration'
    ;

    protected static function boot()
    {
        parent::boot();

        static::creating(fn (Order $order) => $order->{$order->getKeyName()} = (string) Str::uuid());
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['count', 'price']);
    }

}
