<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $perPage = 9999;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'login_at',
        'avatar',
        'active_status',
        'role_id',
        'department_id',
        'position_id',
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
        'login_at' => 'timestamp',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members', 'member_id', 'project_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function expenditures()
    {
        return $this->hasMany(Expenditure::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        });

        $query->when($filters['role_id'] ?? false, function ($query, $roleId) {
            return $query->where('role_id', $roleId);
        });

        $query->when($filters['department_id'] ?? false, function ($query, $departmentId) {
            return $query->where('department_id', $departmentId);
        });

        $query->when($filters['position_id'] ?? false, function ($query, $positionId) {
            return $query->where('position_id', $positionId);
        });
    }

    public function scopeOnline($query)
    {
        return $query->where('login_at', '!=', null);
    }

    public function scopeRoleId($query, $roleId)
    {
        return $query->where('role_id', $roleId);
    }

    public function scopeDepartmentId($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    public function scopePositionId($query, $positionId)
    {
        return $query->where('position_id', $positionId);
    }
}
