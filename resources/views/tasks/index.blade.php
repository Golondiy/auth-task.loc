@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Новая задача</div>

                <!-- Bootstrap шаблон... -->

		<div class="panel-body">
		    <!-- Отображение ошибок проверки ввода -->
		    @include('common.errors')

		    <!-- Форма новой задачи -->
		    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
			{{ csrf_field() }}

			<!-- Имя задачи -->
			<div class="form-group">
			    <label for="task" class="col-sm-3 control-label">Задача</label>

			    <div class="col-sm-6">
				<input type="text" name="name" id="task-name" class="form-control">
			    </div>
			</div>

			<!-- Кнопка добавления задачи -->
			<div class="form-group">
			    <div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-default">
				    <i class="fa fa-plus"></i> Добавить задачу
				</button>
			    </div>
			</div>
		    </form>
		</div>


            </div>
	    <!-- Текущие задачи -->
	    @if (count($tasks) > 0)
	    <div class="panel panel-default">
		<div class="panel-heading">
		    Текущие задачи
		</div>

		<div class="panel-body">
		    <table class="table table-striped task-table">

			<!-- Заголовок таблицы -->
			<thead>
			<th>Задача</th>
			<th>Действие</th>
			</thead>

			<!-- Тело таблицы -->
			<tbody>
			    @foreach ($tasks as $task)
			    <tr>
				<!-- Имя задачи -->
				<td class="table-text">
				    <div>{{ $task->name }}</div>
				</td>

				<td>
				    <!-- TODO: Кнопка Удалить -->
				    <form action="{{ url('task/'.$task->id) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}

					<button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
					    <i class="fa fa-btn fa-trash"></i>Удалить
					</button>
				    </form>
				</td>
			    </tr>
			    @endforeach
			</tbody>
		    </table>
		</div>
	    </div>
	    @endif
        </div>
    </div>
</div>
@endsection
