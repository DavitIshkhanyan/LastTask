<?php

namespace App\Http\Controllers;

use App\Comment;
use Faker\Provider\ar_JO\Company;
use Illuminate\Http\Request;
use App\Photo;
use Illuminate\Support\Facades\Auth;
use App\User;
//use Auth;

class PhotosController extends Controller
{
    public function create($album_id)
    {
        return view('photos.create')->with('album_id', $album_id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png|image|max:1999'
        ]);

//        $path = $request->file('photo')->store('photos', 'public');

        $filenameWithExt = $request->file('photo')->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('photo')->getClientOriginalExtension();

        $filenameToStore = $filename.'_'.time().'.'.$extension;

        $path = $request->file('photo')->storeAs('public/album_photos', $filenameToStore);

        Photo::create([
            'album_id' => $request->input('album_id'),
            'title' => $request->input('title'),
//            'photo' => $path
            'photo' => $filenameToStore
        ]);

        return redirect('/albums/'.$request->input('album_id'))->with('info','Photo Uploaded');
    }

    public function destroy($id)
    {
        PhotosController::destroyPhotoLikes($id);

        while(Photo::find($id)->comments->count() > 0){
            PhotosController::destroyCommLikes(Photo::find($id)->comments[0]->id);
            Comment::destroy(Photo::find($id)->comments[0]->id);
        }

        Photo::destroy($id);
        return redirect()->back();
    }

    public function photoReply(Request $request, $id)
    {
        $request->validate([
            "reply-{$id}" => 'required|max:1000'
        ]);

        $photo = Photo::find($id);

        if( ! $photo ) redirect()->route('home');
//        dd($photo->album->user);

        if( ! Auth::user()->isFriendWith($photo->album->user) &&  Auth::user()->id !== $photo->album->user->id ) {
            return redirect()->route('home');
        }

        Comment::create([
            'photo_id' => $id,
            'body' => $request->input("reply-{$id}"),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back();

    }

    public function destroyReply($id)
    {
        PhotosController::destroyCommLikes($id);
        $comment = Comment::find($id);
        if( Auth::user()->id !== User::find($comment->user_id)->id) redirect()->route('home');

        Comment::destroy($id);
        return redirect()->back();
    }

    public function getLike($id)
    {
        $photo = Photo::find($id);

        if( ! $photo ) redirect()->route('home');

        if ( ! Auth::user()->isFriendWith($photo->album->user) &&  Auth::user()->id !== $photo->album->user->id){
            return redirect()->route('home');
        }

        if ( Auth::user()->hasLikedPhoto($photo) ) {
            return redirect()->back();
        }

        $photo->likes()->create(['user_id' => Auth::user()->id]);

        return redirect()->back();
    }

    public function destroyPhotoLike($id)
    {
        $photo = Photo::find($id);

        if( ! $photo ) redirect()->route('home');

        if ( ! Auth::user()->isFriendWith($photo->album->user) &&  Auth::user()->id !== $photo->album->user->id){
            return redirect()->route('home');
        }

        for($i = 0; $i < $photo->likes->count(); $i++){
            if($photo->likes[$i]->user_id === Auth::user()->id){
                $photo->likes[$i]->delete();
            }
        }

        return redirect()->back();
    }

    public function destroyPhotoLikes($id)
    {
        $photo = Photo::find($id);

        if( ! $photo ) redirect()->route('home');

        if ( ! Auth::user()->isFriendWith($photo->album->user) &&  Auth::user()->id !== $photo->album->user->id){
            return redirect()->route('home');
        }

        $photo->likes()->delete(['user_id' => Auth::user()->id]);

        return redirect()->back();
    }

    public function getCommLike($id)
    {
        $comm = Comment::find($id);

        if( !$comm ) redirect()->route('home');

        if ( ! Auth::user()->isFriendWith($comm->user) &&  Auth::user()->id !== $comm->user->id){
            return redirect()->route('home');
        }

        if ( Auth::user()->hasLikedComm($comm) ) {
            return redirect()->back();
        }

        $comm->likes()->create(['user_id' => Auth::user()->id]);

        return redirect()->back();
    }

    public function destroyCommLike($id)
    {
        $comm = Comment::find($id);

        if( !$comm ) redirect()->route('home');

        if ( ! Auth::user()->isFriendWith($comm->user) &&  Auth::user()->id !== $comm->user->id){
            return redirect()->route('home');
        }

        for($i = 0; $i < $comm->likes->count(); $i++){
            if($comm->likes[$i]->user_id === Auth::user()->id){
                $comm->likes[$i]->delete();
            }
        }

        return redirect()->back();
    }

    public function destroyCommLikes($id)
    {
        $comm = Comment::find($id);

        if( !$comm ) redirect()->route('home');

        if ( ! Auth::user()->isFriendWith($comm->user) &&  Auth::user()->id !== $comm->user->id){
            return redirect()->route('home');
        }

        $comm->likes()->delete(['user_id' => Auth::user()->id]);

        return redirect()->back();
    }
}
