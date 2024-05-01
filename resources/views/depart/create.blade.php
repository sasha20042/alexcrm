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
        <h1 class="mb-4">Додати Виїзд</h1>
        <hr />

        <form action="{{ route('depart.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col">
                    <label for="countrySelect" class="form-label">Проект\завод</label>
                    <input type="text" name="title" id="companyInput" class="form-control" placeholder="Проект\завод">
                </div>
                <div class="col">
                    <label for="companyInput" class="form-label">Термін набору</label>
                    <input type="text" name="date" id="companyInput" class="form-control" placeholder="Дата">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="cityInput" class="form-label">Загальна Кількість людей</label>
                    <input type="text" name="city" id="cityInput" class="form-control" placeholder="Кількість">
                </div>
                <div class="col">
                    <label for="vacancyInput" class="form-label">Інформація виїзду:</label>
                    <input type="text" name="description" id="vacancyInput" class="form-control" placeholder="Тип виїзду">
                </div>
            </div>

            

            <div class="col">
                <button type="submit" class="btn btn-primary mt-4">Додати</button>
            </div>

        </form>
    </div>
     @endsection
