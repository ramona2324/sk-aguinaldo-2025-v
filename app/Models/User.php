<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    // Helper methods for use types
    public function isMember(): bool
    {
        return $this->user_type === 'Member';
    }

    public function isOfficial(): bool
    {
        return $this->user_type === 'Official';
    }

    public function isSuperAdmin(): bool
    {
        return $this->user_type === 'Superadmin';
    }

    public function isApproved(): bool
    {
        return $this->status === 'Approved';
    }

    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }

    public function isRejected(): bool
    {
        return $this->status === 'Rejected';
    }
}
