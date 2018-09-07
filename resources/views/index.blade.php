@extends('layouts.master')
@section('content')

<table>
    <thead>
      <tr>
          <th>Task</th>
          <th>Assigned to</th>
          <th>Edit</th>
          <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><a href="">Make a joint.</a></td>
        <td>Woody Harrison</td>
        <td><a title="edit" href=""><i class="small material-icons">edit</i></a></td>
        <td><a title="delete" href=""><i class="small material-icons">delete</i></a></td>
      </tr>
    </tbody>
</table>

<ul class="pagination">
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li class="active"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
</ul>

<form class="col s12">
    <div class="row">
        <div class="input-field col s12">
            <input id="task" type="text" class="validate">
            <label for="task">New Task</label>
        </div>
    </div>

    <div class="input-field col s12">
        <select>
          <option value="" disabled selected>Assign To:</option>
          <option value="1">To myself</option>
          <option value="2">Buzz Lightyear</option>
          <option value="3">Pajaro</option>
        </select>
        <label>Assign Task</label>
    </div>

    <a class="waves-effect waves-light btn">Add new task</a>
</form>

<br><br><br>

<ul class="collection with-header">
    <li class="collection-header"><h4>My Coworkers</h4></li>
    <li class="collection-item"><div>Buzz Lightyear<a href="#!" class="secondary-content">Delete</a></div></li>
    <li class="collection-item"><div>Charles Manson<a href="#!" class="secondary-content">Delete</a></div></li>
</ul>

@endsection


