<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class NavController extends Controller
{
    private $table = 'navs';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = [
            'code' => 500,
            'msg' => 'failed'
        ];
        try {
            $nav = DB::table($this->table)
                ->get();
            if (!empty($nav))
                $result = [
                    'code' => 200,
                    'data' => $nav
                ];
        } catch (Exception $e) {

        }
        echo json_encode($result);

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
            echo json_encode([
                'code' => 500,
                'msg' => 'please input your nav'
            ]);

        $condition = [
            'nav' => $request['nav'],
            'nav_name' => $request['nav_name'],
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ];
        $id = DB::table($this->table)
            ->insertGetId($condition);
        if (!empty($id))
            echo json_encode([
                'code' => 200,
                'data' => $id
            ]);
        else
            echo json_encode([
                'code' => 500,
                'msg' => 'failed'
            ]);
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
            echo json_encode([
                'code' => 500,
                'msg' => 'id must be a number'
            ]);

        $result = [
            'code' => 500,
            'msg' => 'failed'
        ];
        try {
            $nav = DB::table($this->table)
                ->where('id', $id)
                ->first();
            if (!empty($nav))
                $result = [
                    'code' => 200,
                    'data' => $nav
                ];
            else
                $result = [
                    'code' => 202,
                    'msg' => 'not exists'
                ];
        } catch (Exception $e) {

        }
        echo json_encode($result);
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
            echo json_encode([
                'code' => 500,
                'msg' => 'id must be a number'
            ]);

        if (empty($request))
            echo json_encode([
                'code' => 500,
                'msg' => 'please input your nav'
            ]);
        try {
            $condition['updated_at'] = date('Y-m-d H:i:s', time());

            if (!empty($request['nav']))
                $condition['nav'] = $request['nav'];
            if (!empty($request['nav_name']))
                $condition['nav_name'] = $request['nav_name'];

            $res = DB::table($this->table)
                ->where('id', $id)
                ->update($condition);
            if ($res)
                echo json_encode([
                    'code' => 200,
                    'data' => true
                ]);
        } catch (Exception $e) {
            echo json_encode([
                'code' => 500,
                'msg' => 'failed'
            ]);
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
            echo json_encode([
                'code' => 500,
                'msg' => 'id must be a number'
            ]);

        try {
            $res = DB::table($this->table)
                ->where('id', $id)
                ->delete();
            if ($res)
                echo json_encode([
                    'code' => 200,
                    'data' => true
                ]);
        } catch (Exception $e) {
            echo json_encode([
                'code' => 500,
                'msg' => 'failed'
            ]);
        }
    }
}
