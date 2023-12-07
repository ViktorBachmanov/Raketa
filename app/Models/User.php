<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use App\Models\Product;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'manager_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Get the role that owns the user
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }


    public function isManager(): bool
    {
        return $this->role->name === RoleEnum::Manager;
    }

    public function getAccessibleProducts()
    {
        if ($this->isManager()) {
            return $this->employees()->reduce(function ($allProducts, $employee) {
                return $allProducts->concat($employee->products);
            }, collect([]));
        } else {
            return $this->products;
        }
    }

    private function employees()
    {
        return self::where('manager_id', $this->id)->get();
    }

    /**
     * Get the products for the user
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
