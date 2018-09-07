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

    <ul class="pagination">
        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        <li class="active"><a href="#!">1</a></li>
        <li class="waves-effect"><a href="#!">2</a></li>
        <li class="waves-effect"><a href="#!">3</a></li>
        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>

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
    <form class="col s12" action="">
        <div class="input-field">
            <select>
                <option value="" disabled selected>Send invitation To:</option>
                <option value="1">Buzz Lightyear</option>
                <option value="2">Pajaro</option>
            </select>
            <label>Send Invitation</label>
        </div>
        <a class="waves-effect waves-light btn">Send Invitation</a>
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


