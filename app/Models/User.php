<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

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
        'profile_photo_path',
        'role',
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
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return '/storage/' . ltrim($this->profile_photo_path, '/');
        }

        $parts = preg_split('/\s+/', trim((string) $this->name));
        $initials = collect($parts)
            ->filter()
            ->take(2)
            ->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))
            ->implode('');

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256">'
            . '<rect width="100%" height="100%" fill="#E5E7EB"/>'
            . '<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="90" fill="#374151">'
            . e($initials ?: 'U')
            . '</text></svg>';

        return 'data:image/svg+xml;utf8,' . rawurlencode($svg);
    }

    public function joinedClasses()
    {
        return $this->belongsToMany(CourseClass::class, 'join_classes', 'student_user_id',
            'course_class_id');
    }

    public function createdClasses()
    {
        return $this->hasMany(CourseClass::class, 'creator_user_id');
    }

    public function studentGrades()
    {
        return $this->hasMany(StudentGrade::class, 'student_user_id');
    }

    public function studentData()
    {
        return $this->hasOne(StudentData::class, 'id');
    }

    public function courseClass()
    {
        return $this->belongsToMany(
            CourseClass::class,
            'join_classes',
            'student_user_id',
            'course_class_id'
        );
    }
}
