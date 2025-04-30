<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Status extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
     
        protected $fillable = [
            'id',
            'title',
            // другие поля статуса
        ];
    
        /**
         * Получение всех заявок со статусом
         */
        public function applications() 
        {
            return $this->hasMany(Application::class);
        }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
       
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         
    ];
}
