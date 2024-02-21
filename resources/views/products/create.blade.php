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
    }

    h1 {
        color: #007bff;
        text-align: center;
    }

    hr {
        border-color: #007bff;
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

    .btn-primary {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
<div class="container">
    <h1 class="mb-4">Додати клієнта</h1>
    <hr />

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label">ПІБ</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Введіть ПІБ" required>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Номер телефону</label>
                <input type="text" name="price" class="form-control" id="price" placeholder="Введіть номер телефону" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="product_code" class="form-label">Вакансія</label>
                <input type="text" name="product_code" class="form-control" id="product_code" placeholder="Введіть вакансію" required>
            </div>
            <div class="col-md-6">
                <label for="manager" class="form-label">Менеджер</label>
                <input type="text" name="manager" class="form-control" id="manager" placeholder="Введіть ім'я менеджера" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="sex" class="form-label">Стать</label>
                <input type="text" name="sex" class="form-control" id="sex" placeholder="Введіть стать">
            </div>
            <div class="col-md-6">
                <label for="age" class="form-label">Дата народження</label>
                <input type="date" name="age" class="form-control" id="age" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="description" class="form-label">Статус</label>
                <select name="description" class="form-select" id="description" required>
                    <option value="На опрацюванні">На опрацюванні</option>
                    <option value="Відправлено на роботу">Відправлено на роботу</option>
                    <option value="На резерв">На резерв</option>
                    <option value="Відмовився">Відмовився</option>
                    <option value="Уточнення">Уточнення</option>
                    <option value="Підбір вакансії">Підбір вакансії</option>
                    <option value="Ми відмовили">Ми відмовили</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </div>
    </form>
</div>

@endsection