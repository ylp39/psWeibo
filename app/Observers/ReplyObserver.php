<?php

namespace App\Observers;

use App\Models\Reply;

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $reply->status->reply_count = $reply->status->replies->count();
        $reply->status->save();
    }
}
