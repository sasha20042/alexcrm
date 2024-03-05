@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<style>
 body {
        background-color: #f8f9fa;
    }

    .container {
        background-color: #ffffff;
        margin-top: 30px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
    }

    .details-container {
        flex: 1;
    }

    .logs-container {
        background-color: #e9ecef;
        padding: 15px;
        border-radius: 5px;
        margin-left: 20px;
        flex-basis: 300px;
        height: fit-content;
    }

    h1 {
        color: #0724ff;
        text-align: center;
    }

    hr {
        border-color: #1707ff;
    }

    .form-label {
        color: #343a40;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    textarea.form-control {
        resize: vertical;
    }

    .btn-warning {
        background-color: #3007ff;
        color: #212529;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-warning:hover {
        background-color: #001eff;
    }

    .logs-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .log-item {
        background-color: #ffffff;
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 8px;
        margin-bottom: 5px;
    }
</style>

<div class="container">
    <div class="details-container">
        <h1 class="mb-4">Деталі</h1>
        <hr />

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">ПІБ</label>
        <input type="text" name="title" class="form-control" value="{{ $product->title }}" readonly>
    </div>
    <div class="col-md-6">
        <label class="form-label">Номер телефону</label>
        <input type="text" name="price" class="form-control" value="{{ $product->price }}" readonly>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">Стать</label>
        <input type="text" name="sex" class="form-control" value="{{ $product->sex }}" readonly>
    </div>
    <div class="col-md-4">
        <label class="form-label">Дата народження</label>
        <input type="date" name="age" class="form-control" value="{{ $product->age }}" readonly>
    </div>
    <div class="col-md-4">
        <label class="form-label">Вакансія</label>
        <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}" readonly>
    </div>
    <div class="col-md-6">
        <label for="citizenship" class="form-label">Громадянство</label>
        <input type="text" name="citizenship" class="form-control" id="citizenship" value="{{ $product->citizenship }}" readonly>
    
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6 mb-3">
        <label for="location" class="form-label">Місцезнаходження</label>
        <input type="text" name="location" class="form-control" id="location" value="{{ $product->location }}" readonly>
    </div>
    <div class="col-md-6">
        <label class="form-label">Менеджер</label>
        <input type="text" name="manager" class="form-control" value="{{ $product->manager }}" readonly>
    </div>
    <div class="col-md-6">
        <label class="form-label">Стан</label>
        <textarea class="form-control" name="description" readonly>{{ $product->description }}</textarea>
    </div>
</div>
<div class="logs-container">
    <div class="logs-title">Остання взаємодія</div>
    <!-- Приклад логу, ви можете замінити це на реальні логи вашого додатку -->
    <input type="text" name="updated_at" class="form-control" value="Оновлено:{{ $product->updated_at }}" readonly>
    <input type="text" name="created_at" class="form-control" value="Створено:{{ $product->created_at }}" readonly>
</div>
<br>
<br>
<br>
<br>

@endsection