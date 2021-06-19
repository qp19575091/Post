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
            $this->likes()->where('user_id', auth()->user()->id)->delete();
            return response()->json(['message' => 'Success. Has been cancel like'], 200);
        }
        $this->likes()->create(['user_id' => auth()->user()->id]);
        return response()->json(['message' => 'Success. Has been like'], 200);
    }

    // public function dislike()
    // {
    //     if ($this->isLike()) {
    //         $this->likes()->where('user_id', auth()->user()->id)->delete();
    //         return response()->json(['message' => 'Success.']);
    //     }
    //     return $this;
    // }

    public function sumLike(Model $model, $id)
    {
        $count = Like::where([
            'likeable_type' => get_class($model),
            'likeable_id' => $id
        ])->count();

        return response()->json(['number of the post like' => $count, 'message' => 'Success']);
    }
}
