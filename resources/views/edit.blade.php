@extends('layouts.master')
@section('content')

<form method="POST" action="{{ route('update',$task->id) }}" class="col s12">
    <div class="row">
        <div class="input-field col s12">
            <input name="task" value="{{ $task->content }}" id="edit_task" type="text" class="validate">
            <label for="edit_task">Edit Task</label>
        </div>
    </div>

    @include('partials.coworkers')

    <button type="submit" class="waves-effect waves-light btn">Edit task</button>
    @csrf
</form>

@endsection


