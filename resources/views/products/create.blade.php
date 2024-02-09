@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <h1 class="mb-0">Додати клієнта</h1>
    <hr />
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="title" class="form-control" placeholder="ПІБ">
            </div>
            <div class="col">
                <input type="text" name="price" class="form-control" placeholder="Номер телефону">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="product_code" class="form-control" placeholder="Вакансія">
            </div>
            <div class="col">
                <input type="text" name="manager" class="form-control" placeholder="Менеджер">
            </div>
            <div class="col">
                 <select name="description" required="required" class="form-control">
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
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </div>
    </form>
@endsection