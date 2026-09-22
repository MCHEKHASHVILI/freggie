<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserProfile extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        // Explicit, rather than relying on the package/Filament config
        // defaults: Filament's SpatieMediaLibraryFileUpload falls back to
        // config('filament.default_filesystem_disk') (= FILESYSTEM_DISK,
        // "local" here) when a collection has no disk of its own, which is
        // a *different* fallback than Media Library's own FileAdder uses
        // for non-Filament uploads (config('media-library.disk_name')) —
        // avatars uploaded through the panel silently ended up on the
        // private "local" disk instead of "public".
        $this->addMediaCollection('avatar')->useDisk('public')->singleFile();
    }

    /**
     * The profile owner's name and surname, trimmed together.
     */
    public function fullName(): string
    {
        return trim("{$this->name} {$this->surname}");
    }

    public function avatarUrl(): ?string
    {
        return $this->getFirstMediaUrl('avatar') ?: null;
    }
}
