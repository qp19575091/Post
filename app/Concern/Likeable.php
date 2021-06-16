<?php

namespace App\Concern;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Likeable
{
    public function likes(): morphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLike()
    {
        return $this->likes()->where('user_id', auth()->user()->id)->exists();
    }

    public function like()
    {
        if ($this->isLike()) {
            return $this;
        }
        return $this->likes()->create(['user_id' => auth()->user()->id]);
    }

    public function dislike()
    {
        if ($this->isLike()) {
            return $this->likes()->where('user_id', auth()->user()->id)->delete();
        }
        return $this;
    }

    public function sumLike(Model $model, $id)
    {
        return Like::where([
            'likeable_type' => get_class($model),
            'likeable_id' => $id
        ])->count();
    }
}
