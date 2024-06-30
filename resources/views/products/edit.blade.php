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
        padding: 10px;
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
    .iti {
            width: 100%;
        }

        .intl-tel-input {
            width: calc(100% - 100px); /* Зменшуємо ширину на 100px */
        }

        .intl-tel-input .selected-flag {
            height: auto !important;
            width: 30px !important;
        }

        .intl-tel-input .selected-flag .iti-flag {
            margin-top: -2px !important;
        }

        .intl-tel-input .selected-flag .iti-arrow {
            margin-top: -2px !important;
        }
    
</style>
<script src="build/js/countrySelect.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <h2 class="mb-4">Взаємодія з кандидатом</h2>
    <hr />

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="row">
            <div class="col-md-6 border-end">
                <div class="mb-3">
                    <label for="phone" class="form-label fs-5"><i class="fa-brands fa-viber"></i> Номер телефону</label>
                    <div class="input-group">
                        <input id="phone" style="width: 500px;" type="tel" name="price" class="form-control fs-6" id="phone" value="{{ $product->price }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label fs-5">Прізвище Ім'я</label>
                    <input type="text" name="title" class="form-control fs-6" id="title" placeholder="Введіть ПІБ" value="{{ $product->title }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fs-5">Стать</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="Чоловік" {{ $product->sex === 'Чоловік' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="male">Чоловік</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="Жінка" {{ $product->sex === 'Жінка' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="female">Жінка</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="age" class="form-label fs-5">Вік</label>
                        <input type="text" name="age" class="form-control fs-6" id="age" value="{{ $product->age }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="citizenship" class="form-label fs-5">Громадянство</label>
                    <input type="text" name="age" class="form-control fs-6" id="age" value="{{ $product->citizenship }}" required>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label fs-5">Місцезнаходження (Країна)</label>
                    <select id="country" name="location" class="form-control fs-6" required>
                        <option value="">Виберіть країну</option>
                        <option value="Україна" {{ $product->location === 'Україна' ? 'selected' : '' }}>Україна</option>
                        <option value="Словаччина" {{ $product->location === 'Словаччина' ? 'selected' : '' }}>Словаччина</option>
                        <option value="Угорщина" {{ $product->location === 'Угорщина' ? 'selected' : '' }}>Угорщина</option>
                        <option value="Чехія" {{ $product->location === 'Чехія' ? 'selected' : '' }}>Чехія</option>
                    </select>
                </div>
                
            </div>
    
            <div class="col-md-6 border-end">
                <div class="mb-3">
                    <label for="product_code" class="form-label fs-5">Вакансія</label>
                    <input type="text" name="age" class="form-control fs-6" id="age" value="{{ $product->product_code }}" required>
                </div>
    
                <div class="mb-3">
                    <label for="interaction_source" class="form-label fs-5">Джерело взаємодії</label>
                    <select name="interaction_source" class="form-select fs-6" id="interaction_source" required>
                        <option value="" selected disabled>Виберіть джерело взаємодії</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Instagram">Instagram</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="YouTube">Telegram</option>
                        <!-- Додайте інші соціальні мережі за потреби -->
                    </select>
                </div>
    
                <div class="mb-3">
                    <label for="description" class="form-label fs-5">Статус</label>
                    <select name="description" class="form-select fs-6" id="description" required>
                        <option value="На опрацюванні" {{ $product->description === 'На опрацюванні' ? 'selected' : '' }}>На опрацюванні</option>
                        <option value="На оформленні" {{ $product->description === 'На оформленні' ? 'selected' : '' }}>На оформленні</option>
                        <option value="Відправлено на роботу" {{ $product->description === 'Відправлено на роботу' ? 'selected' : '' }}>Відправлено на роботу</option>
                        <option value="На резерв" {{ $product->description === 'На резерв' ? 'selected' : '' }}>На резерв</option>
                        <option value="Відмовився" {{ $product->description === 'Відмовився' ? 'selected' : '' }}>Відмовився</option>
                        <option value="Уточнення" {{ $product->description === 'Уточнення' ? 'selected' : '' }}>Уточнення</option>
                        <option value="Підбір вакансії" {{ $product->description === 'Підбір вакансії' ? 'selected' : '' }}>Підбір вакансії</option>
                        <option value="Ми відмовили" {{ $product->description === 'Ми відмовили' ? 'selected' : '' }}>Ми відмовили</option>
                    </select>
                </div>
    
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary">Оновити</button>
                </div>
            </div>
        </div>
    </form>
    
</div>
<script>
    
</script>
@endsection