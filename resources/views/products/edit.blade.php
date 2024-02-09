@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <h1 class="mb-0">Змінити</h1>
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ПІБ</label>
                <input type="text" name="title" class="form-control" placeholder="ПІБ" value="{{ $product->title }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Номер</label>
                <input type="text" name="price" class="form-control" placeholder="Номер" value="{{ $product->price }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Вакансія</label>
                <input type="text" name="product_code" class="form-control" placeholder="Вакансія" value="{{ $product->product_code }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Менеджер</label>
                <input type="text" name="manager" class="form-control" placeholder="Менеджер" value="{{ $product->manager }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Стан</label>
                <textarea class="form-control" name="description" placeholder="Стан" >{{ $product->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Оновити</button>
            </div>
        </div>
    </form>
@endsection