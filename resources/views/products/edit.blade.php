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
        color: #ffc107;
        text-align: center;
    }

    hr {
        border-color: #ffc107;
    }

    .form-label {
        color: #343a40;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    textarea.form-control {
        resize: vertical;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-warning:hover {
        background-color: #ffae00;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <h2 class="mb-4">Взаємодія з кандидатом</h2>
    <hr />

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">ПІБ</label>
                <input type="text" name="title" class="form-control" placeholder="ПІБ" value="{{ $product->title }}" >
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Номер</label>
                <input type="text" name="price" class="form-control" placeholder="Номер" value="{{ $product->price }}" >
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Стать</label>
                <input type="text" name="sex" class="form-control" placeholder="Стать" value="{{ $product->sex }}" >
            </div> 
            <div class="col-md-4 mb-3">
                <label class="form-label">Дата народження</label>
                <input type="text" name="age" class="form-control" placeholder="Дата народження" value="{{ $product->age }}" >
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Вакансія</label>
                <input type="text" name="product_code" class="form-control" placeholder="Вакансія" value="{{ $product->product_code }}" >
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="description" class="form-label">Статус</label>
                <select name="description" class="form-select" id="description" required>
                    <option value="На опрацюванні" {{ $product->description == 'На опрацюванні' ? 'selected' : '' }}>На опрацюванні</option>
                    <option value="Відправлено на роботу" {{ $product->description == 'Відправлено на роботу' ? 'selected' : '' }}>Відправлено на роботу</option>
                    <option value="На резерв" {{ $product->description == 'На резерв' ? 'selected' : '' }}>На резерв</option>
                    <option value="Відмовився" {{ $product->description == 'Відмовився' ? 'selected' : '' }}>Відмовився</option>
                    <option value="Уточнення" {{ $product->description == 'Уточнення' ? 'selected' : '' }}>Уточнення</option>
                    <option value="Підбір вакансії" {{ $product->description == 'Підбір вакансії' ? 'selected' : '' }}>Підбір вакансії</option>
                    <option value="Ми відмовили" {{ $product->description == 'Ми відмовили' ? 'selected' : '' }}>Ми відмовили</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="location" class="form-label">Місцезнаходження</label>
                <input type="text" name="location" class="form-control" id="location" value="{{ $product->location }}" required>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Чорний список</label>
            <div class="form-check">
                <input type="radio" name="blacklist" class="form-check-input" id="blacklist_yes" value="yes" {{ $product->blacklist == 'yes' ? 'checked' : '' }}>
                <label for="blacklist_yes" class="form-check-label">Так</label>
            </div>
            <div class="form-check">
                <input type="radio" name="blacklist" class="form-check-input" id="blacklist_no" value="no" {{ $product->blacklist == 'no' ? 'checked' : '' }}>
                <label for="blacklist_no" class="form-check-label">Ні</label>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <button class="btn btn-warning">Оновити</button>
            </div>
            <!-- Додайте інші кнопки або дії за необхідності -->
        </div>
    </form>
</div>

@endsection