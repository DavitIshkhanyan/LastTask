<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Photo;
use Illuminate\Http\Request;
use App\User;
use App\Album;
use Auth;
//use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PhotosController;


class AlbumsController extends Controller
{
    public function index()
    {
//        $user = User::where('username',$username)->first();

        $albums = Auth::user()->albums();
//        dd($albums);

        return view('albums.index', ['albums' => $albums]);
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover_image' => 'required|mimes:jpg,jpeg,png|image|max:999'
        ]);

//        $path = $request->file('cover_image')->store('albums', 'public');

        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('cover_image')->getClientOriginalExtension();

        $filenameToStore = $filename.'_'.time().'.'.$extension;

        $path = $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);



        Album::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'cover_image' => $filenameToStore
        ]);

        return redirect()->route('albums.index')->with('info','Album Created');
    }

    public function show($id)
    {
        $album = Album::with('photos')->find($id);
        $user = $album->user()->get();
        $user_id = $user[0]->id;
        $photos = $album->photos()->orderBy('created_at', 'desc')->paginate(1);
        return view('albums.show', ['album'=>$album, 'user_id'=>$user_id, 'photos'=>$photos]);
    }

    public function destroy($id)
    {
        while(Album::find($id)->photos->count() > 0){
            $PhotosController = new PhotosController();
            $PhotosController->destroy(Album::find($id)->photos[0]->id);
        }

        Album::destroy($id);

        return redirect()->route('albums.index');
    }
}
