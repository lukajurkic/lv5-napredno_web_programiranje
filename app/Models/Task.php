<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Tipovi studija kao konstante
    public const TYPE_STRUCNI = 'strucni';
    public const TYPE_PREDDIPLOMSKI = 'preddiplomski';
    public const TYPE_DIPLOMSKI = 'diplomski';

    /**
     * Polja koja se mogu masovno dodjeljivati
     */
    protected $fillable = [
        'user_id',
        'title_hr',
        'title_en',
        'description',
        'study_type',
    ];

    /**
     * Relacija Task → User (nastavnik koji je dodao rad)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Provjera tipa studija
     */
    public function isStrucni(): bool
    {
        return $this->study_type === self::TYPE_STRUCNI;
    }

    public function isPreddiplomski(): bool
    {
        return $this->study_type === self::TYPE_PREDDIPLOMSKI;
    }

    public function isDiplomski(): bool
    {
        return $this->study_type === self::TYPE_DIPLOMSKI;
    }
}
