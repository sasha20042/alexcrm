@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <h1 class="mb-0">Додати клієнта</h1>
    <hr />
    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                 <select name="country" required="required" class="form-control">
                        <option value="Угорщина">Угорщина</option>
                        <option value="Словаччина">Словаччина</option>
                        <option value="Чехія">Чехія</option>
                 </select>
                
            </div>
            <div class="col">
                <input type="text" name="company" class="form-control" placeholder="Компанія">
            </div>
            <div class="col">
                <input type="text" name="city" class="form-control" placeholder="Місто">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="vacancy" class="form-control" placeholder="Вакансія">
            </div>
            <div class="col">
                <input type="text" name="job" class="form-control" placeholder="Робота">
            </div>
            
        </div>
 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </div>
    </form>
@endsection