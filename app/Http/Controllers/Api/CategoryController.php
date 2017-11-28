<?php

namespace App\Http\Controllers\Api;

use App\Http\Common\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CategoryController extends Controller
{
    private $table = 'categories';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cat = DB::table($this->table)
                ->get();
            if (!empty($cat))
                Message::jsonMsg(200, $cat);
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
        if (empty($request))
            Message::jsonMsg(500, 'please input your category info');

        $condition = [
            'cat' => $request['cat'],
            'cat_name' => $request['cat_name'],
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
            $cat = DB::table($this->table)
                ->where('id', $id)
                ->first();
            if (!empty($cat))
                Message::jsonMsg(200, $cat);
            else
                Message::jsonMsg(202, 'not exists');
        } catch (Exception $e) {
            Message::jsonMsg(500, 'failed');
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
        if (!is_numeric($id))
            Message::jsonMsg(500, 'id must be a number');

        if (empty($request))
            Message::jsonMsg(500, 'nothing to update');

        try {
            $condition['updated_at'] = date('Y-m-d H:i:s', time());

            if (!empty($request['cat']))
                $condition['cat'] = $request['cat'];
            if (!empty($request['cat_name']))
                $condition['cat_name'] = $request['cat_name'];

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
        if (!is_numeric($id))
            Message::jsonMsg(500, 'id must be a number');
        try {
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
