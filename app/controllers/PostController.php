<?php

namespace App\Controllers;

use App\Models\Post;
use Kernel\Http\Request;
use Kernel\Storage;
use Utils\FilterRequest;

class PostController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function index()
    {
        $request = new Request();
        $message = $request->input('message') ? $request->input('message') : 'Success php framework';

        return view('post/index', [
            'message' => $message,
            'posts' => $this->post->all()
        ]);
    }

    public function upload()
    {
        $request = new Request();
        $file = $request->input('file');

        $storage = new Storage();
        $path = '/post/' . $file->getFileName() . '.' . $file->getFileExtension();
        $storage->put($path, $file->get());

        return redirect('/post');
    }

    public function submit()
    {
        $request = new Request();
        $params = $request->only(['name', 'context']);
        $params = FilterRequest::get($params);

        $create = $this->post->create($params);

        return redirect('/post');
    }

    public function edit()
    {
        $request = new Request();
        $id = $request->input('id');

        $find = $this->post->find($id);

        return view('post/update', [
            'post' => $find->get()
        ]);
    }

    public function update()
    {
        $request = new Request();
        $params = $request->only(['name', 'context']);
        $params = FilterRequest::get($params);
        $id = $request->input('id');

        $find = $this->post->find($id);
        $find->fill($params);
        $find->save();

        return redirect('/post');
    }

    public function delete()
    {
        $request = new Request();
        $id = $request->input('id');

        $find = $this->post->find($id);
        $find->delete();

        return redirect('/post');
    }
}