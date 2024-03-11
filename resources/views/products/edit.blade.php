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
<div class="container">
    <h1 class="mb-4">Змінити</h1>
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
            <div class="col-md-6">
                <label for="citizenship" class="form-label">Громадянство</label>
                <input type="text" name="citizenship" class="form-control" id="citizenship" value="{{ $product->citizenship }}" >
            
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