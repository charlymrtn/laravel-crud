@extends('layouts.master')
@section('content')

    <table>
        <thead>
        <tr>
            <th>Task</th>
            @isAdmin
            <th>Assigned to</th>
            @endisAdmin
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $tasks as $task)
                <tr>
                    <td>
                        <a href="{{ route('updateStatus',$task->id) }}">
                            @if(!$task->status)
                            {{ $task->content }}
                            @else
                            <strike>{{ $task->content }}</strike>
                            @endif
                        </a>
                    </td>
                    @isAdmin
                    <td> {{ $task->user->name }} </td>
                    @endisAdmin
                    <td><a title="edit" href="{{ route('edit',$task->id) }}"><i class="small material-icons">edit</i></a></td>
                    <td><a title="delete" onclick="return confirm('Delete?');" href="{{ route('delete',$task->id) }}"><i class="small material-icons">delete</i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tasks->links('vendor.pagination.materialize') }}

    <form method="POST" action="{{ route('store') }}" class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <input name="task" id="task" type="text" class="validate">
                <label for="task">New Task</label>
            </div>
        </div>

        @include('partials.coworkers')

        <button type="submit" class="waves-effect waves-light btn">Add new task</button>
        @csrf
    </form>

    @isWorker
    <br><br><br>
    <form method="POST" action="{{ route('sendInvitation') }}" class="col s12" action="">
        <div class="input-field">
            <select name="admin">
                <option value="" disabled selected>Send invitation To:</option>
                @foreach ($coworkers as $coworker)
                    <option value="{{ $coworker->id }}">{{ $coworker->name }}</option>
                @endforeach
            </select>
            <label>Send Invitation</label>
        </div>
        <button type="submit" class="waves-effect waves-light btn">Send Invitation</button>
        @csrf
    </form>

    @endisWorker

    @isAdmin
    <br><br><br>

    <ul class="collection with-header">
        <li class="collection-header"><h4>My Coworkers</h4></li>
        <li class="collection-item"><div>Buzz Lightyear<a href="#!" class="secondary-content">Delete</a></div></li>
        <li class="collection-item"><div>Charles Manson<a href="#!" class="secondary-content">Delete</a></div></li>
    </ul>
    @endisAdmin

@endsection


