<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Invitation;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(){

        if (Auth::user()->is_admin) {

            $coworkers = Invitation::where('admin_id',Auth::user()->id)->where('accepted',1)->get();
            $invitations = Invitation::where('admin_id',Auth::user()->id)->where('accepted',0)->get();
            $tasks = Task::where('user_id',Auth::user()->id)->orWhere('admin_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(4);
        }else{

            $invitations = [];
            $tasks = Task::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(4);
            $coworkers = User::where('is_admin',1)->get();
        }

        return view('index',compact('tasks','coworkers','invitations'));
    }

    public function store(Request $request){

        if($request->input('task')){

            $task = new Task;
            $task->content = $request->input('task');

            if(Auth::user()->is_admin){
                if ($request->input('assignTo') == Auth::user()->id) {

                    Auth::user()->tasks()->save($task);

                }elseif($request->input('assignTo') != null){

                    $task->user_id = $request->input('assignTo');
                    $task->admin_id =  Auth::user()->id;
                    $task->save();

                }
            }else{
                Auth::user()->tasks()->save($task);
            }

        }

        return redirect()->back();

    }

    public function edit($id){

        $task = Task::find($id);
        if (Auth::user()->is_admin) {
            $coworkers = Invitation::where('admin_id',Auth::user()->id)->where('accepted',1)->get();
            $invitations = Invitation::where('admin_id',Auth::user()->id)->where('accepted',0)->get();
        }else{
            $coworkers = [];
            $invitations = [];
        }
        return view('edit', compact('task','coworkers','invitations'));
    }

    public function delete($id){

        $task = Task::find($id);

        if (!Auth::user()->is_admin) {
            if(!$this->_authorize($task->user_id)){
                return redirect()->back();
                exit();
            }
        }
        $task->delete();

        return redirect()->back();
    }

    public function update(Request $request, $id){

        if ($request->input('task')) {

            $task = Task::find($id);
            $task->content = $request->input('task');
            if (Auth::user()->is_admin) {

                if ($request->input('assignTo') == Auth::user()->id) {

                    Auth::user()->tasks()->save($task);

                }elseif($request->input('assignTo') != null){

                    $task->user_id = $request->input('assignTo');
                    $task->admin_id =  Auth::user()->id;
                    $task->save();

                }

            }else{
                if($this->_authorize($task->user_id))
                $task->save();
            }

        }

        return redirect('/');

    }

    public function updateStatus($id){
        $task = Task::find($id);

        $task->status = !$task->status;
        if ($this->_authorize($task->user_id)) {

            $task->save();
        }

        return redirect()->back();
    }

    public function sendInvitation(Request $request){

        if ((int)$request->input('admin') > 0
        && !Invitation::where('worker_id',Auth::user()->id)
                        ->where('admin_id',$request->input('admin'))
                        ->exists()) {

            $invitation = new Invitation;

            $invitation->worker_id = Auth::user()->id;
            $invitation->admin_id = $request->input('admin');
            $invitation->save();

        }

        return redirect()->back();
    }

    public function updateInvitation($id, $status){
        $invitation = Invitation::find($id);

        if ($status == '1') {
            $invitation->accepted = true;
            if ($this->_authorize($invitation->admin_id)) {
                # code...
                $invitation->save();
            }
        }else{
            if ($this->_authorize($invitation->admin_id)) {
                # code...
                $invitation->delete();
            }
        }

        return redirect()->back();
    }

    public function deleteWorker($id){
        $invitation = Invitation::find($id);
        if ($this->_authorize($invitation->admin_id)) {
            # code...
            $invitation->delete();
        }

        return redirect()->back();
    }

    protected function _authorize($id){

        return Auth::user()->id === $id ? true : false;
    }

}
