<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use DataTables;
use App\Providers\TaskService;


class TaskBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Tasks::latest()->get();

        if ($request->ajax()) {
            return DataTables::of($tasks)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';

                     return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('taskboard', compact('tasks'));
    }

    /**
     * Store/update resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tasks::updateOrCreate([
            'id' => $request->id
        ],[
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => 1
        ]);

        $request->user_id = 1;

        if($request->id){
            (new TaskService)->updateTask($request->user_id, $request->name, $request->description, $request->user_id, $request->is_done);
        }else{
            (new TaskService)->createNewTask($request->id, $request->name, $request->description, $request->user_id, $request->is_done);
        }

        // return response
        $response = [
            'success' => true,
            'message' => 'Tasks saved successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Tasks $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = Tasks::find($id);
        return response()->json($tasks);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($task)
    {
        if ((new TaskService)->delete($task)){
            // return response
            $response = [
                'success' => true,
                'message' => 'Task deleted successfully.',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Something went wrong :(.',
            ];
            return response()->json($response, 400);
        }
    }
}