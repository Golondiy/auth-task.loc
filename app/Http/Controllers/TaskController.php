<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;

class TaskController extends Controller {

    /**
     * Создание нового экземпляра контроллера.
     *
     * @return void
     */
    public function __construct() {
	$this->middleware('auth');
    }

    /**
     * Отображение списка всех задач пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request) {
	$tasks = $request->user()->tasks()->get();

	//для версии 5.1
	//$tasks = Task::where('user_id', $request->user()->id)->get();

	return view('tasks.index', [
	    'tasks' => $tasks,
	]);
    }

    /*
     * @param  Request  $request
     * @return Response
     */

    public function store(Request $request) {
	$this->validate($request, [
	    'name' => 'required|max:255',
	]);

	// Создание задачи...

	$request->user()->tasks()->create([
	    'name' => $request->name,
	]);

	return redirect('/tasks');
    }

    /**
     * Уничтожение заданной задачи.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task) {
	$this->authorize('destroy', $task);

	$task->delete();

	return redirect('/tasks');
    }

}
