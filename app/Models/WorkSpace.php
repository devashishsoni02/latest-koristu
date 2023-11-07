<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSpace extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status','slug','is_disable'
    ];
    // protected $appends = ['slug'];
    // public function getSlugAttribute()
	// {
	//     return \Str::slug($this->name);
	// }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($workspace) {

            $workspace->slug = $workspace->createSlug($workspace->name);

            $workspace->save();
        });
    }

    private function createSlug($name)
    {
        if (static::whereSlug($slug = \Str::slug($name))->exists()) {

            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');

            if (isset($max[-1]) && is_numeric($max[-1])) {

                return preg_replace_callback('/(\d+)$/', function ($mathces) {

                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
