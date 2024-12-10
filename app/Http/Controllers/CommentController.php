<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'pizza_id' => $request->pizzaId,
            'comment' => $request->message
        ]);

        Alert::success('Comment Create', 'Comment Created Successfully!');

        return back();
    }

    public function delete($id)
    {
        Comment::where('id', $id)->delete();
        return back();
    }
}
