<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user ,Post $post)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $request->user()->comentarios()->create([
            'content' => $request->content,
            'post_id' => $post->id
        ]);

        return back()->with('success', 'Comentario creado con éxito');
    }
}
