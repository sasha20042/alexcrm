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
        #infoContainer {
        max-width: 600px;
        margin: auto;
        font-family: 'Arial', sans-serif;
    }
    #infoContainer h2 {
        color: #007bff;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    #infoContainer p {
        font-size: 1.1rem;
        margin-bottom: 10px;
    }
    #infoContainer p strong {
        color: #000000;
    }
    #editButton {
        display: block;
        width: 100%;
        font-size: 1.2rem;
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


<div class="container mt-4 shadow-m position-relative" style="background-color: #ffffff;  padding-top: 3rem;">
    <div class="title-frame position-absolute p-2 shadow-sm" style="background-color: #ffffff; border-radius: 10px;  border: 1px solid black;top: -1.5rem; left: 1rem; margin: 0; color: #000000;">
        <h2 style="margin: 0;">Взаємодія з кандидатом</h2>
    </div>
    <div class="manager-name position-absolute p-2 shadow-sm " style="background-color: #a7f085; border: 1px solid black; border-radius: 10px; top: -1.5rem; right: 1rem;">
        <strong>Менеджер: {{ auth()->user()->name }}</strong>
      </div>
    <hr style="color: rgb(255, 208, 0); border: 2px;">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="editForm" style="display: none;">
        @csrf
        @method('PUT')
        <input type="hidden" name="manager" class="form-control fs-6" id="manager" value="{{ auth()->user()->name }}" readonly>
    
        <div class="row">
            <div class="col-md-6 border-end">
                <h4>Основна інформація</h4>
    
                <div class="mb-3">
                    <label for="price" class="form-label fs-5"><i class="fa-brands fa-viber"></i> Номер телефону</label>
                    <div class="input-group">
                        <input id="phone" style="width: 100%;" type="tel" name="price" class="form-control fs-6" value="{{ $product->price }}" required>
                    </div>
                </div>
    
                <div class="mb-3">
                    <label for="title" class="form-label fs-5">Прізвище Ім'я</label>
                    <input type="text" name="title" class="form-control fs-6" id="title" placeholder="Введіть ПІБ" value="{{ $product->title }}" required>
                </div>
    
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="age" class="form-label fs-5">Вік</label>
                        <input type="number" name="age" class="form-control fs-6" id="age" value="{{ $product->age }}" required min="17" max="60" style="width: 90px;">
                        <div id="ageError" class="text-danger" style="display: none;">Вік повинен бути від 17 до 60 років.</div>
                    </div>
                    <div class="col-md-2 mb-3">
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
    
                    <div class="col-md-2 mb-3">
                        <label class="form-label fs-5">Пара</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasFamily" id="hasFamilyYes" value="Так" {{ $product->hasFamily === 'Так' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="hasFamilyYes">Так</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasFamily" id="hasFamilyNo" value="Ні" {{ $product->hasFamily === 'Ні' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="hasFamilyNo">Ні</label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fs-5">Діти</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasChildren" id="hasChildrenYes" value="Так" {{ $product->hasChildren === 'Так' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="hasChildrenYes">Так</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasChildren" id="hasChildrenNo" value="Ні" {{ $product->hasChildren === 'Ні' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="hasChildrenNo">Ні</label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fs-5">Тварини</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasPets" id="hasPets" value="Так" {{ $product->hasPets === 'Так' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="hasPets">Так</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasPets" id="hasPetsNo" value="Ні" {{ $product->hasPets === 'Ні' ? 'checked' : '' }} required >
                            <label class="form-check-label" for="hasPetsNo">Ні</label>
                        </div>
                    </div>
                </div>
    
                <div id="childrenOptions" style="display: none;">
                    <div class="mb-3">
                        <label for="childrenCount" class="form-label fs-5">Скільки дітей</label>
                        <input type="number" id="childrenCount" name="childrenCount" class="form-control fs-6" value="{{ $product->childrenCount }}">
                    </div>
                    <div id="childrenAges" class="mb-3">
                        <!-- Додаткові поля для віку дітей будуть додані за допомогою JS -->
                    </div>
                </div>
    
                <div class="mb-3">
                    <label for="citizenship" class="form-label fs-5">Громадянство</label>
                    <select name="citizenship" class="form-select fs-6" id="citizenship" required>
                        <option value="" selected disabled>Виберіть країну</option>
                        <option value="Угорщина" {{ $product->citizenship === 'Угорщина' ? 'selected' : '' }}>Угорщина</option>
                        <option value="Україна" {{ $product->citizenship === 'Україна' ? 'selected' : '' }}>Україна</option>
                        <option value="Словаччина" {{ $product->citizenship === 'Словаччина' ? 'selected' : '' }}>Словаччина</option>
                        <option value="Чехія" {{ $product->citizenship === 'Чехія' ? 'selected' : '' }}>Чехія</option>
                    </select>
                </div>
    
                <div class="mb-3">
                    <label for="country" class="form-label fs-5">Місцезнаходження (Країна)</label>
                    <select id="country" name="location" class="form-select fs-6" required>
                        <option value="">Виберіть країну</option>
                        <option value="Україна" {{ $product->location === 'Україна' ? 'selected' : '' }}>Україна</option>
                        <option value="Словаччина" {{ $product->location === 'Словаччина' ? 'selected' : '' }}>Словаччина</option>
                        <option value="Угорщина" {{ $product->location === 'Угорщина' ? 'selected' : '' }}>Угорщина</option>
                        <option value="Чехія" {{ $product->location === 'Чехія' ? 'selected' : '' }}>Чехія</option>
                    </select>
                </div>
    
               
            </div>
    
            <div class="col-md-6">
                <h4>Додаткова інформація</h4>
    
                <div class="mb-3">
                   
                </div>
                <div class="mb-3">
                    <label for="documentType" class="form-label fs-5">Тип документа</label>
                    <select name="documentType" class="form-select fs-6" id="documentType">
                        <option value="Біо паспорт" {{ $product->documentType === 'Біо паспорт' ? 'selected' : '' }}>Біо паспорт</option>
                        <option value="Айді карта" {{ $product->documentType === 'Айді карта' ? 'selected' : '' }}>ID карта</option>
                    </select>
                </div>
    
                <div class="mb-3">
                    <label for="residence" class="form-label fs-5">Місце проживання (Місто)</label>
                    <input type="text" name="residence" class="form-control fs-6" id="residence" placeholder="Введіть місто" value="{{ $product->residence }}">
                </div>
    
    
                <div class="mb-3">
                    <label for="comment" class="form-label fs-5">Коментарі</label>
                    <textarea name="comment" class="form-control fs-6" id="comment" rows="4" placeholder="Введіть коментарі">{{ $product->comment }}</textarea>
                </div>
            </div>
    
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
    </form>
    
    <div id="infoContainer" class="container mt-4 shadow-m position-relative" style="background-color: #d6d6d6; border: 2px solid black; padding-top: 3rem;">
        <p class="title-frame position-absolute p-2" style="background-color: #d6d6d6; border: 2px solid black; border-radius: 10px; top: -1.5rem; left: 1rem; margin: 0; color: #000000;">
            <strong>Інформація про кандидата</strong>
        </p>
        
     
        <p><strong>Номер телефону:</strong> {{ $product->price }}</p>
        <p><strong>Прізвище Ім'я:</strong> {{ $product->title }}</p>
        <p><strong>Вік:</strong> {{ $product->age }}</p>
        <p><strong>Стать:</strong> {{ $product->sex }}</p>
        <p><strong>Пара:</strong> {{ $product->hasFamily }}</p>
        <p><strong>Діти:</strong> {{ $product->hasChildren }}</p>
        <p><strong>Тварини:</strong> {{ $product->hasPets }}</p>
        <p><strong>Громадянство:</strong> {{ $product->citizenship }}</p>
        <p><strong>Місцезнаходження:</strong> {{ $product->location }}</p>
        <p><strong>Тип документа:</strong> {{ $product->documentType }}</p>
        <p><strong>Країна документу:</strong> {{ $product->residenceStatus }}</p>
        <p><strong>Коментарі:</strong> {{ $product->comment }}</p>
        <button id="editButton" class="btn btn-primary mt-3">Редагувати</button>
    </div>
    
    
   
    
    
    
</div>
<script>
     document.getElementById('editButton').addEventListener('click', function() {
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('infoContainer').style.display = 'none';
    });
    document.addEventListener("DOMContentLoaded", function() {
        const hasChildrenYes = document.getElementById("hasChildrenYes");
        const hasChildrenNo = document.getElementById("hasChildrenNo");
        const childrenOptions = document.getElementById("childrenOptions");
        const childrenCount = document.getElementById("childrenCount");
        const childrenAges = document.getElementById("childrenAges");

        const euExperience = document.getElementById("euExperience");
        const euExperienceQuestions = document.getElementById("euExperienceQuestions");

        const additionalInfoBtn = document.getElementById("additionalInfoBtn");
        const additionalInfo = document.getElementById("additionalInfo");

        const updateChildrenAges = () => {
            childrenAges.innerHTML = "";
            const count = parseInt(childrenCount.value) || 0;
            for (let i = 0; i < count; i++) {
                const div = document.createElement("div");
                div.className = "mb-3";
                div.innerHTML = `
                    <label for="childAge${i}" class="form-label fs-5">Вік дитини ${i + 1}</label>
                    <input type="number" name="childrenAges[]" class="form-control fs-6" id="childAge${i}" required>
                `;
                childrenAges.appendChild(div);
            }
        };

        hasChildrenYes.addEventListener("change", function() {
            if (this.checked) {
                childrenOptions.style.display = "block";
                updateChildrenAges();
            }
        });

        hasChildrenNo.addEventListener("change", function() {
            if (this.checked) {
                childrenOptions.style.display = "none";
                childrenAges.innerHTML = "";
            }
        });

        childrenCount.addEventListener("input", updateChildrenAges);

        euExperience.addEventListener("change", function() {
            if (this.value === "Так") {
                euExperienceQuestions.style.display = "block";
            } else {
                euExperienceQuestions.style.display = "none";
            }
        });

        additionalInfoBtn.addEventListener("click", function() {
            additionalInfo.style.display = additionalInfo.style.display === "none" ? "block" : "none";
        });

        // Initialize visibility based on existing data
        if (hasChildrenYes.checked) {
            childrenOptions.style.display = "block";
            updateChildrenAges();
        }
        if (euExperience.value === "Так") {
            euExperienceQuestions.style.display = "block";
        }
        if (additionalInfo.style.display === "block") {
            additionalInfoBtn.click();
        }
    });
</script>
@endsection