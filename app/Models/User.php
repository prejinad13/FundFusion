<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }

    
    public function ideas()
   {
        return $this->hasMany(Idea::class, 'investee_id');
   }
    // ── Connections ──────────────────────────────────────────────

    /** Requests this user has SENT */
    public function sentConnections()
    {
        return $this->hasMany(Connection::class, 'sender_id');
    }

    /** Requests this user has RECEIVED */
    public function receivedConnections()
    {
        return $this->hasMany(Connection::class, 'receiver_id');
    }

    /**
     * Check connection status with another user.
     * Returns: 'none' | 'pending' | 'accepted' | 'rejected'
     */
    public function connectionStatusWith(int $userId): string
    {
        $connection = Connection::where(function ($q) use ($userId) {
            $q->where('sender_id', $this->id)->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $this->id);
        })->first();

        return $connection ? $connection->status : 'none';
    }

    /**
     * Get all investors connected to this user (accepted connection requests).
     */
    public function connectedInvestors()
    {
        $userIds = \App\Models\Connection::where('status', 'accepted')
            ->where(function ($q) {
                $q->where('sender_id', $this->id)->orWhere('receiver_id', $this->id);
            })
            ->get()
            ->map(function ($conn) {
                return $conn->sender_id == $this->id ? $conn->receiver_id : $conn->sender_id;
            })
            ->toArray();

        return self::whereIn('id', $userIds)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'investor');
            })
            ->get();
    }
}