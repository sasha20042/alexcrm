@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Montserrat', sans-serif;
    }

    .container {
        background-color: #ffffff;
        margin: 30px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 800px;
    }

    .form-label {
        font-weight: bold;
        color: #343a40;
    }

    .form-control, .form-select {
        border-radius: 8px;
        font-size: 1rem;
        padding: 10px;
        border: 1px solid #ced4da;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 1rem;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-section {
        margin-bottom: 30px;
    }

</style>

<div class="container">
    <h3 class="mb-4">Внесення кандидатів, {{ auth()->user()->name }}</h3> 
    <hr />
    
    <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label for="phoneInput" class="form-label">Номер Телефону</label>
                <input type="text" name="number" id="phoneInput" class="form-control" placeholder="Введіть номер телефону">
            </div>
            <div class="col">
                <label for="projectInput" class="form-label">Найменування</label>
                <input type="text" name="date" id="projectInput" class="form-control" placeholder="Назва проекту або заводу">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="countInput" class="form-label">Кількість</label>
                <input type="text" name="count" id="countInput" class="form-control" placeholder="Введіть кількість">
            </div>
            <div class="col">
                <label for="locationInput" class="form-label">Місцезнаходження</label>
                <input type="text" name="location" id="locationInput" class="form-control" placeholder="Введіть місцезнаходження">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="codeInput" class="form-label">Інвентаризаційний Код</label>
                <input type="text" name="code" id="codeInput" class="form-control" placeholder="Введіть інвентаризаційний код">
            </div>
            <div class="col">
                <label for="managerInput" class="form-label">Менеджер</label>
                <input type="text" name="manager" class="form-control fs-6" id="manager" value="{{ auth()->user()->name }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="statusInput" class="form-label">Статус</label>
                <input type="text" name="status" id="statusInput" class="form-control" placeholder="Введіть статус">
            </div>
            <div class="col">
                <label for="commentInput" class="form-label">Коментар</label>
                <input type="text" name="comment" id="commentInput" class="form-control" placeholder="Ваш коментар">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="noteInput" class="form-label">Додаткова інформація (Посилання)</label>
                <input type="text" name="note" id="noteInput" class="form-control" placeholder="Посилання або додаткова інформація">
            </div>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary mt-4">Додати</button>
        </div>
    </form>
</div>

@endsection
