@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <h1 class="mb-0">Деталі</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">ПІБ</label>
            <input type="text" name="title" class="form-control" placeholder="ПІБ" value="{{ $product->title }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Номер телефону</label>
            <input type="text" name="price" class="form-control" placeholder="Номер телефону" value="{{ $product->price }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Вакансія</label>
            <input type="text" name="product_code" class="form-control" placeholder="Вакансія" value="{{ $product->product_code }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Менеджер</label>
            <input type="text" name="manager" class="form-control" placeholder="Менеджер" value="{{ $product->manager }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Стан</label>
            <textarea class="form-control" name="description" placeholder="Вакансія" readonly>{{ $product->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Створено</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Оновлено</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
@endsection