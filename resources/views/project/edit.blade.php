@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <h1 class="mb-0">Змінити</h1>
    <hr />
    <form action="{{ route('project.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Країна</label>
                <input type="text" name="country" class="form-control" placeholder="Країна" value="{{ $project->country }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Компанія</label>
                <input type="text" name="company" class="form-control" placeholder="Компанія" value="{{ $project->company }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Місто</label>
                <input type="text" name="city" class="form-control" placeholder="Місто" value="{{ $project->city }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Вакансія</label>
                <input type="text" name="vacancy" class="form-control" placeholder="Вакансія" value="{{ $project->vacancy }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Тип Роботи</label>
                <textarea class="form-control" name="job" placeholder="Тип Роботи" >{{ $project->job }}</textarea>
            </div>
      
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Оновити</button>
            </div>
        </div>
    </form>
@endsection