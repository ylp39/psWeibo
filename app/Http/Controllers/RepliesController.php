<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request,Reply $reply)
    {
        $this->validate($request,[
            'content' => 'required|max:140|min:2',
        ]);
        $reply->content = $request['content'];
        $reply->user_id = Auth::id();
        $reply->status_id = $request['status_id'];
        $reply->save();

        return redirect()->to($reply->status->link())->with('success', '评论创建成功！');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy',  $reply);
        $reply->delete();

        return redirect()->to($reply->status->link())->with('success', '评论删除成功！');
    }

}
