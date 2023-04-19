<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortURI extends Model
{
    use HasFactory;

    protected $fillable = ['originalLink', 'shortURI'];

    public static function findByOriginalLink($originalLink)
    {
        return self::query()->where('originalLink', $originalLink)->first();
    }

    public static function createRecord($link)
    {
        return self::query()->create([
            'originalLink' => $link,
            'shortURI' => str_random(8)]);
    }

    public static function findByShortURI($shortURI)
    {
        return self::query()->where('shortURI', $shortURI)->first();
    }
}
