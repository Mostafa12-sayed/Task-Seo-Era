<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\PostValidationException;

class Post extends Model
{
    use HasFactory;

    const MAX_DESCRIPTION_SIZE = 2048; // 2KB
    const PREVIEW_LENGTH = 512;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'contact_phone_number',
        'slug'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Boot method for validation
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (strlen($post->description) > self::MAX_DESCRIPTION_SIZE) {
                throw new PostValidationException('Description cannot exceed 2KB');
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWithUser($query)
    {
        return $query->with('user:id,username,email');
    }

    // Accessors
    public function getDescriptionPreviewAttribute(): string
    {
        return strlen($this->description) > self::PREVIEW_LENGTH
            ? substr($this->description, 0, self::PREVIEW_LENGTH) . '...'
            : $this->description;
    }

    public function getDescriptionSizeAttribute(): int
    {
        return strlen($this->description);
    }
}
