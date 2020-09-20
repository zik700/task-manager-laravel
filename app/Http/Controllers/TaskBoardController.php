<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use DataTables;


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

                    $btn = 'Edit';

                    $btn = $btn . ' Delete';

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
            'description' => $request->description
        ]);

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
    public function destroy(Tasks $tasks)
    {
        $tasks->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'Task deleted successfully.',
        ];
        return response()->json($response, 200);
    }
}