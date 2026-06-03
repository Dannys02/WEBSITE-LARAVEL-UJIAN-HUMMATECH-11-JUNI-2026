<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'phone', 'image'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function formatPhoneInWelcome()
    {
        $phone = preg_replace('/\D/', '', $this->phone);

        if (str_starts_with($phone, '62')) {
            $phone = substr($phone, 2);
        }

        return '+62 ' .
            substr($phone, 0, 3) . '-' .
            substr($phone, 3, 4) . '-' .
            substr($phone, 7);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function details()
    {
        return $this->hasMany(RentalDetail::class);
    }
}
