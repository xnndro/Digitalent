<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Alert;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::orderBy('likes', 'desc')->get();

        $count = Forum::count();
        // $count = 0;
        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }
        return view('user.pages.forum.index', compact('forums', 'count'));
    }

    public function admin_forum()
    {
        $forums = Forum::orderBy('likes', 'desc')->get();

        $count = Forum::count();
        return view('admin.pages.forum.index', compact('forums', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.pages.forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $forum = new Forum([
            'judul' => $request->get('judul'),
            'deskripsi' => $request->get('deskripsi'),
            'user_id' => Auth::id()
        ]);

        $forum->save();

        return redirect()->route('forum.index')->withSuccessMessage('Threads berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $forum = Forum::find($id);

    //     return view('forum.show', compact('forum'));
    // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $forum = Forum::find($id);

    //     return view('forum.edit', compact('forum'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'body' => 'required|string'
    //     ]);

    //     $forum = Forum::find($id);
    //     $forum->title = $request->get('title');
    //     $forum->body = $request->get('body');
    //     $forum->save();

    //     return redirect()->route('forum.index')->with('success', 'Forum berhasil diupdate');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $forum = Forum::find($id);
    //     $forum->delete();

    //     return redirect()->route('forum.index')->with('success', 'Forum berhasil dihapus');
    // }



    public function like(Request $request, $id)
    {
        $forum = Forum::find($id);
        $like = Like::where('user_id', Auth::id())->where('forum_id', $id)->first();
        if ($like) {
            $like->delete();
            $forum->likes = $forum->likes - 1;
            $forum->save();
        } else {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->forum_id = $id;
            $like->save();
            $forum->likes = $forum->likes + 1;
            $forum->save();
        }

        return redirect()->route('forum.index');
    }

    public function sort()
    {
        $forum = Forum::orderBy('like', 'desc')->get();

        return view('forum.index', compact('forum'));
    }
}

