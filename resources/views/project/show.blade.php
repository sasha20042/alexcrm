@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <h1 class="mb-0">Деталі</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Країна</label>
            <input type="text" name="country" class="form-control" placeholder="Країна" value="{{ $project->country }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Компанія</label>
            <input type="text" name="company" class="form-control" placeholder="Компанія" value="{{ $project->company }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Місто</label>
            <input type="text" name="city" class="form-control" placeholder="Місто" value="{{ $project->city }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Вакансія</label>
            <input type="text" name="vacancy" class="form-control" placeholder="Вакансія" value="{{ $project->vacancy }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Тип Роботи</label>
            <textarea class="form-control" name="job" placeholder="Тип Роботи" readonly>{{ $project->job }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Створено</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $project->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Оновлено</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $project->updated_at }}" readonly>
        </div>
    </div>
@endsection