<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // "SELECT title, content FROM posts"
        $posts = DB::table('posts')
                    ->select('id','title','content','created_at')
                    ->get();
        $view_data = [
            'posts' => $posts
        ];
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n",$posts);

        // //
        // // echo "list Dari Post";
        // $view_data = [
        //     'posts' => $posts
        //         // tittle                   Content
        //         // [ " Mengenal Laravel", "ini adalah Blog Tentng pengenalan laravel"],
        //         // [ " Tentang CodePolitan", "ini adalah Blog Tentng pengenalan laravel"],
          
        //     // 'posts' => ['Satu','dua','tiga'],
        //     // 'comments' => "Ini Komentar",
        // ];
        return view('posts.index',$view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        // menghubungkan ke database yang sebelumnya sudah dibuat
        DB::table('posts')->insert([
            'title' => $title,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n",$posts);

        // $new_post = [
        //     count($posts) + 1,
        //     $title,
        //     $content,
        //     date('d-m-Y H:i:s')
        // ];
        
        // $new_post = implode(',', $new_post);
        
        // array_push($posts, $new_post);
        // $posts = implode("\n",$posts);

        // Storage::write('posts.txt', $posts);

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $post = DB::table('posts')
            ->select('id','title','content','created_at')
            ->Where('id','=',$id)
            ->first();
        $view_data =[
            'post' => $post
        ];
        return view('posts.show',$view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = DB::table('posts')
            ->select('id','title','content','created_at')
            ->Where('id','=',$id)
            ->first();
            $view_data =[
                'post' => $post
            ];
            return view('posts.edit',$view_data);
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        DB::table('posts')
            ->where('id',$id)
            ->update([
                'title' => $title,
                'content' => $content,
                'updated_at' => date('Y-m-d H:i:s'),

            ]);
        return redirect("posts/{$id}");
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('posts')
        ->where('id',$id)
        ->delete();   
        return redirect("posts");
    }
}
