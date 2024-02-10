@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Список</h1>
        <a href="{{ route('project.create') }}" class="btn btn-primary">Додати клієнта</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>№</th>
                <th>Країна</th>
                <th>Компанія</th>
                <th>Місто</th>
                <th>Вакансія</th>
                <th>Тип Роботи</th>
                <th>Дія</th>
            </tr>
        </thead>
        <tbody>
            @if($project->count() > 0)
                @foreach($project as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->country }}</td>
                        <td class="align-middle">{{ $rs->company }}</td>
                        <td class="align-middle">{{ $rs->city }}</td>
                         <td class="align-middle">{{ $rs->vacancy }}</td>
                         <td class="align-middle">{{ $rs->job }}</td>  
                       
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('project.show', $rs->id) }}" type="button" class="btn btn-secondary">Деталі</a>
                                <a href="{{ route('project.edit', $rs->id)}}" type="button" class="btn btn-warning">Змінити</a>
                                <form action="{{ route('project.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Точно видалити?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Видалити</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Не знайдено</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection