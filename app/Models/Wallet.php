<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property string name
 * @property string address
 * @property string user_id
 * @property string created_at
 * @property string updated_at
 */
class Wallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'chain_id',
    ];

    public function chain()
    {
        return $this->belongsTo(Chain::class);
    }
}
