@extends('layouts.master')
@section('content')

<form class="col s12">
    <div class="row">
        <div class="input-field col s12">
            <input value="task content to edit" id="edit_task" type="text" class="validate">
            <label for="edit_task">Edit Task</label>
        </div>
    </div>

    <a class="waves-effect waves-light btn">Edit task</a>
</form>

@endsection


