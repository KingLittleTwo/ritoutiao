<?php

namespace App\Http\Controllers\Api;

use App\Http\Common\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class PostController extends Controller
{
    private $table = 'posts';
    private $user_info = [];
    public function __construct()
    {
        $this->user_info = session('user_info');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = DB::table($this->table)
                ->get();
            if (!empty($posts))
                Message::jsonMsg(200, $posts);

        } catch (Exception $e) {
            Message::jsonMsg(500, 'failed');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($this->user_info))
            Message::jsonMsg(500, 'you must be signin');

        if (empty($request['title']))
            Message::jsonMsg(500, 'please input the title');
        if (empty($request['cat_id']))
            Message::jsonMsg(500, 'please input the cat_id');
        if (empty($request['content']))
            Message::jsonMsg(500, 'please input the content');
        if (empty($request['author_id']))
            Message::jsonMsg(500, 'please input the author_id');

        $condition = [
            'title' => $request['title'],
            'category_id' => $request['cat_id'],
            'content' => $request['content'],
            'author_id' => $this->user_info->author_id,
            'tag_id' => !empty($request['tag_id']) ? implode(',', $request['tag_id']) : '',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ];
        $id = DB::table($this->table)
            ->insertGetId($condition);
        if (!empty($id))
            Message::jsonMsg(200, $id);
        else
            Message::jsonMsg(500, 'failed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!is_numeric($id))
            Message::jsonMsg(500, 'id must be a number');

        try {
            $nav = DB::table($this->table)
                ->where('id', $id)
                ->first();
            if (!empty($nav))
                Message::jsonMsg(200, $nav);
            else
                Message::jsonMsg(202, 'not exists');
        } catch (Exception $e) {
            Message::jsonMsg(201, 'failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (empty($this->user_info))
            Message::jsonMsg(500, 'you must be signin');

        if (!is_numeric($id))
            Message::jsonMsg(500, 'id must be a number');
        if (empty($request))
            Message::jsonMsg(500, 'nothing to update');
        try {
            $post = DB::table($this->table)
                ->select('author_id')
                ->where('id', $id)
                ->first();
            if ($post->author_id != $this->user_info->author_id)
                Message::jsonMsg(500, 'only the autor can edit the post');

            $condition['updated_at'] = date('Y-m-d H:i:s', time());

            if (!empty($request['title']))
                $condition['title'] = $request['title'];
            if (!empty($request['category_id']))
                $condition['category_id'] = $request['cat_id'];
            if (!empty($request['content']))
                $condition['content'] = $request['content'];
            if (!empty($request['tag_id']))
                $condition['tag_id'] = $request['tag_id'];

            $res = DB::table($this->table)
                ->where('id', $id)
                ->update($condition);
            if ($res)
                Message::jsonMsg(200, true);
        } catch (Exception $e) {
            Message::jsonMsg(500, 'failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(session('user_info')))
            Message::jsonMsg(500, 'you must be signin');

        if (!is_numeric($id))
            Message::jsonMsg(500, 'id must be a number');
        try {
            $post = DB::table($this->table)
                ->select('author_id')
                ->where('id', $id)
                ->first();
            if ($post->author_id != $this->user_info->author_id)
                Message::jsonMsg(500, 'only the autor can delete the post');

            $res = DB::table($this->table)
                ->where('id', $id)
                ->delete();
            if ($res)
                Message::jsonMsg(200, true);
        } catch (Exception $e) {
            Message::jsonMsg(500, 'failed');
        }
    }

}
