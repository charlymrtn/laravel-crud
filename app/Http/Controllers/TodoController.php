<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(){
        $tasks = Task::all();

        return view('index',compact('tasks'));
    }

    public function store(Request $request){

        if($request->input('task')){

            $task = new Task;
            $task->content = $request->input('task');
            Auth::user()->tasks()->save($task);
        }

        return redirect()->back();

    }

    public function edit($id){

        $task = Task::find($id);
        return view('edit', compact('task'));
    }

    public function delete($id){

        $task = Task::find($id);
        $task->delete();

        return redirect()->back();
    }

    public function update(Request $request, $id){

        if ($request->input('task')) {

            $task = Task::find($id);
            $task->content = $request->input('task');
            $task->save();
        }

        return redirect('/');

    }

    public function updateStatus($id){
        $task = Task::find($id);

        $task->status = !$task->status;
        $task->save();
        return redirect()->back();
    }


}
