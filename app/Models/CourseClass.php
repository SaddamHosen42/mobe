<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CourseClass extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'class_code',
        'thumbnail_img'
    ];

    protected $casts = [
        'settings' => 'object',
    ];

    public function getThumbnailImgUrlAttribute()
    {
        if (empty($this->thumbnail_img)) {
            $name = rawurlencode((string) ($this->name ?: 'Class'));
            return "https://via.placeholder.com/374x210/1E293B/FFFFFF?text={$name}";
        }

        if (filter_var($this->thumbnail_img, FILTER_VALIDATE_URL)) {
            return $this->thumbnail_img;
        }

        $path = ltrim((string) $this->thumbnail_img, '/');

        // Backward compatibility for previously saved paths like "public/thumbnail/...".
        if (str_starts_with($path, 'public/')) {
            $path = substr($path, 7);
        }

        return Storage::url($path);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'join_classes',
            'course_class_id', 'student_user_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_class_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function syllabus()
    {
        return $this->belongsTo(Syllabus::class);
    }
}
