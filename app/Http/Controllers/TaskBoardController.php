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
        $tasks = Tasks::latest()->where('is_done', false)->get();

        if ($request->ajax()) {
            return DataTables::of($tasks)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-outline-primary btn-sm editBook">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-outline-danger btn-sm deleteBook">Delete</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Done" class="btn btn-outline-success btn-sm doneBtn">Done!</a>';
                    
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

        $taskService = new TaskService($request->id);
        $result = $taskService->updateOrCreateTask(
            $request->id,
            $request->name,
            $request->description, 
            $request->user_id
        );

        if($result == true){
            $response = [
                'success' => true,
                'message' => 'Task added/edited successfully.',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Something bad has happened :(.',
            ];
            return response()->json($response, 500);
        }
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
    public function destroy($id)
    {
        $taskService = new TaskService($id);
        $result = $taskService->deleteTask($id);

        if($result == true){
            $response = [
                'success' => true,
                'message' => 'Task deleted successfully.',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Something bad has happened :(.',
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function done ($id){

        $taskService = new TaskService($id);
        $result = $taskService->taskRealize($id, true);
        if($result == true){
            $response = [
                'success' => true,
                'message' => 'Task deleted successfully.',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Something bad has happened :(.',
            ];
            return response()->json($response, 500);
        }

    }

    public function daily(){

        $tasksDaily = Tasks::whereDate('created_at', date("Y-m-d"))->where('is_done', true)->get()->count();

        return $tasksDaily;

    }
}