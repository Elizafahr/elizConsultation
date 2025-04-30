<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Service;

class Application extends Model
{
    protected $fillable = [
        'service_id',
        'date',
        'time',
        'phone',
        'user_id',
        'status_id',
        'payment_type'
    ];

    protected $casts = [
        'date' => 'datetime',
        'payment_type' => 'string'
    ];

    /**
     * Получение услуги заявки
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Получение статуса заявки
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Получение пользователя заявки
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

 
 