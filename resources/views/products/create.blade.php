@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        background-color: #ffffff;
        margin: 30px;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
        .form-label {
            font-weight: bold;
        }
        .form-check-label, .form-control, .form-select {
            font-size: 1rem;
        }
        .input-group input {
            width: 100%;
        }
        .form-section {
            margin-bottom: 30px;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        #additionalInfo {
            margin-top: 20px;
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

<!-- intl-tel-input CSS -->

<script src="build/js/countrySelect.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
    <style>
        #social_media {
          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif, Montserrat, fontAwesome;
          
        }
    </style>
    <script src="https://kit.fontawesome.com/b440ab2580.js" crossorigin="anonymous"></script>

    <div class="container">
        <h3 class="mb-4">Внесення кандидатів, {{ auth()->user()->name }}</h3> 
        <hr />
    
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="manager" class="form-control fs-6" id="manager" value="{{ auth()->user()->name }}" readonly>
            
            <div class="row">
                <div class="col-md-6 border-end">
                    <!-- Основна інформація -->
                    <h4>Основна інформація</h4>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label fs-5"><i class="fa-brands fa-viber"></i> Номер телефону</label>
                        <div class="input-group">
                            <input id="phone" style="width: 100%;" type="tel" name="price" class="form-control fs-6" id="price" required>
                        </div>
                    </div>
    
                    <div class="mb-3">
                        <label for="title" class="form-label fs-5">Прізвище Ім'я</label>
                        <input type="text" name="title" class="form-control fs-6" id="title" placeholder="Введіть ПІБ" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fs-5">Стать</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="male" value="Чоловік" required>
                                <label class="form-check-label" for="male">Чоловік</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="female" value="Жінка" required>
                                <label class="form-check-label" for="female">Жінка</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label fs-5">Вік</label>
                            <input type="number" name="age" class="form-control fs-6" id="age" required style="width: 100px;">
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fs-5">Сімейна пара?</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasFamily" id="hasFamilyYes" value="Так" required>
                                <label class="form-check-label" for="hasFamilyYes">Так</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasFamily" id="hasFamilyNo" value="Ні" required>
                                <label class="form-check-label" for="hasFamilyNo">Ні</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fs-5">Є діти?</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasChildren" id="hasChildrenYes" value="Так" required>
                                <label class="form-check-label" for="hasChildrenYes">Так</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasChildren" id="hasChildrenNo" value="Ні" required>
                                <label class="form-check-label" for="hasChildrenNo">Ні</label>
                            </div>
                        </div>
                    </div>
    
                    <div id="childrenOptions" style="display: none;">
                        <div class="mb-3">
                            <label for="childrenCount" class="form-label fs-5">Скільки дітей</label>
                            <input type="number" id="childrenCount" name="childrenCount" class="form-control fs-6">
                        </div>
                        <div id="childrenAges" class="mb-3">
                            <!-- Додаткові поля для віку дітей будуть додані за допомогою JS -->
                        </div>
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label fs-5">Наявність домашніх улюбленців</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="hasPets" name="hasPets" value="Так">
                            <label class="form-check-label" for="hasPets">Так</label>
                        </div>
                    </div>
    
                    <div class="mb-3">
                        <label for="citizenship" class="form-label fs-5">Громадянство</label>
                        <select name="citizenship" class="form-select fs-6" id="citizenship" required>
                            <option value="" selected disabled>Виберіть країну</option>
                            <option value="Угорщина">Угорщина</option>
                            <option value="Україна">Україна</option>
                            <option value="Словаччина">Словаччина</option>
                            <option value="Чехія">Чехія</option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="country" class="form-label fs-5">Місцезнаходження (Країна)</label>
                        <select id="country" name="location" class="form-select fs-6" required>
                            <option value="">Виберіть країну</option>
                            <option value="Україна">Україна</option>
                            <option value="Словаччина">Словаччина</option>
                            <option value="Угорщина">Угорщина</option>
                            <option value="Чехія">Чехія</option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="region" class="form-label fs-5">Місцезнаходження (Область)</label>
                        <select id="region" name="region" class="form-select fs-6" required disabled>
                            <option value="">Виберіть область</option>
                        </select>
                    </div>
                </div>
    
                <div class="col-md-6">
                    <!-- Додаткова інформація -->
                    <h4>Додаткова інформація</h4>
    
                    <div class="mb-3">
                        <label for="product_code" class="form-label fs-5">Вакансія</label>
                        <select name="product_code" class="form-select fs-6" id="product_code" required>
                            <option value=""></option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="interaction_source" class="form-label fs-5">Джерело взаємодії</label>
                        <select name="interaction_source" class="form-select fs-6" id="interaction_source" required>
                            <option value="" selected disabled>Виберіть джерело взаємодії</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="LinkedIn">LinkedIn</option>
                            <option value="YouTube">Telegram</option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="description" class="form-label fs-5">Статус</label>
                        <select name="description" class="form-select fs-6" id="description" required>
                            <option value="На опрацюванні">На опрацюванні</option>
                            <option value="На оформленні">На оформленні</option>
                            <option value="Відправлено на роботу">Відправлено на роботу</option>
                            <option value="На резерв">На резерв</option>
                            <option value="Відмовився">Відмовився</option>
                            <option value="Уточнення">Уточнення</option>
                            <option value="Підбір вакансії">Підбір вакансії</option>
                            <option value="Ми відмовили">Ми відмовили</option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="documentType" class="form-label fs-5">Тип документа</label>
                        <select name="documentType" class="form-select fs-6" id="documentType">
                            <option value="Біо паспорт">Біо паспорт</option>
                            <option value="Айді карта">Айді карта</option>
                            <option value="Загран паспорт">Загран паспорт</option>
                            <option value="ID карта УВТ">ID карта УВТ</option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="residenceStatus" class="form-label fs-5">Статус перебування</label>
                        <select name="residenceStatus" class="form-select fs-6" id="residenceStatus">
                            <option value="Активний Прихисток">Активний Прихисток</option>
                            <option value="Закритий Прихисток">Закритий Прихисток</option>
                            <option value="Відмова в прихистку">Відмова в прихистку</option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="additionalInfoBtn">Додаткова інформація</button>
                    </div>
                    
                    <div id="additionalInfo" style="display: none;">
                        <!-- Пункт Тип документа -->
                        
                    
                        <!-- Пункт Досвід працевлаштування в ЄС -->
                        <div class="mb-3">
                            <label for="euExperience" class="form-label fs-5">Досвід працевлаштування в ЄС</label>
                            <select name="euExperience" class="form-select fs-6" id="euExperience">
                                <option value="Ні">Ні</option>
                                <option value="Так">Так</option>
                                
                            </select>
                        </div>
                    
                        <!-- Блок з питаннями, якщо є досвід працевлаштування в ЄС -->
                        <div id="euExperienceQuestions" style="display: none;">
                            <div class="mb-3">
                                <label for="euCountriesWorked" class="form-label fs-5">В яких країнах працювали</label>
                                <input type="text" name="euCountriesWorked" class="form-control fs-6" id="euCountriesWorked">
                            </div>
                            <div class="mb-3">
                                <label for="euFactoryWorked" class="form-label fs-5">На якому заводі працювали</label>
                                <input type="text" name="euFactoryWorked" class="form-control fs-6" id="euFactoryWorked">
                            </div>
                            <div class="mb-3">
                                <label for="euCompanyWorked" class="form-label fs-5">Від якої фірми працювали</label>
                                <input type="text" name="euCompanyWorked" class="form-control fs-6" id="euCompanyWorked">
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Додати</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Script to toggle visibility of additional info sections -->
    <script>
        document.getElementById('hasFamilyYes').addEventListener('change', function() {
            document.getElementById('familyOptions').style.display = this.checked ? 'block' : 'none';
        });
    
        document.getElementById('hasChildrenYes').addEventListener('change', function() {
            document.getElementById('childrenOptions').style.display = this.checked ? 'block' : 'none';
        });
        
        document.getElementById('childrenCount').addEventListener('input', function() {
            const count = parseInt(this.value);
            const childrenAges = document.getElementById('childrenAges');
            childrenAges.innerHTML = ''; // Очистити попередні поля
            for (let i = 0; i < count; i++) {
                const ageInput = document.createElement('input');
                ageInput.type = 'number';
                ageInput.name = `childAge_${i + 1}`;
                ageInput.className = 'form-control fs-6 mb-2';
                ageInput.placeholder = `Вік дитини ${i + 1}`;
                childrenAges.appendChild(ageInput);
            }
        });
    
        // Additional Info toggle
       
    
        // EU Experience Questions toggle
        document.getElementById('euExperience').addEventListener('change', function() {
            const euExperienceQuestions = document.getElementById('euExperienceQuestions');
            euExperienceQuestions.style.display = this.value === 'Так' ? 'block' : 'none';
        });
    </script>
    
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- intl-tel-input JS -->
<!-- FontAwesome JS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/20.1.0/js/utils.js" integrity="sha512-6eq826ZpWfomZeckvWDz/GGbZSCgexJafBx3yZ2AADpBakcTk2MFypyXpoia+rxb4Wcni+8t3HKp/3e6pJPeTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    
     document.getElementById('additionalInfoBtn').addEventListener('click', function() {
        var additionalInfo = document.getElementById('additionalInfo');
        if (additionalInfo.style.display === 'none') {
            additionalInfo.style.display = 'block';
        } else {
            additionalInfo.style.display = 'none';
        }
    });
    document.getElementById('euExperience').addEventListener('change', function() {
        var euExperienceQuestions = document.getElementById('euExperienceQuestions');
        if (this.value === 'Так') {
            euExperienceQuestions.style.display = 'block';
        } else {
            euExperienceQuestions.style.display = 'none';
        }
    });
    // Ініціалізуємо intl-tel-input
    $(document).ready(function(){
    $.ajax({
        url: '/api/fetch-vacancies', // Встановіть свій маршрут
        type: 'GET',
        dataType: 'json',
        success: function(response){
            console.log(response);
            var options = '<option value="" disabled selected hidden>Оберіть вакансію</option>';
            $.each(response, function(index, item){
                options += '<option value="'+item.vacancy+'">'+item.vacancy+'</option>';
            });
            $('#product_code').html(options);
        }
    });
});

   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
  preferredCountries: ["ua", "cz", "hu", "sk"],
  utilsScript: "/intl-tel-input/js/utils.js?1712939239769" 
});


   
// Прикріпіть обробник події для подання форми
$('form').submit(function(event) {
    // Зупиняємо стандартну відправку форми
    event.preventDefault();

    // Отримуємо значення номера телефону разом із кодом країни в форматі E.164
    const phoneNumber = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);

    // Оновити значення поля введення телефону перед відправленням форми
    $('#phone').val(phoneNumber);

    // Відправляємо форму через Ajax
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(), // Відправляємо дані форми
        success: function(response) {
            window.location.href = '/products'; // Обробляємо успішну відповідь
        },
        error: function(xhr, status, error) {
            // Якщо статус помилки - ERR_CONNECTION_CLOSED, ігноруємо її
            if (status === 'error' && xhr.status === 0 && xhr.statusText === 'error') {
                return; // Ігноруємо помилку
            }
            
            // В інших випадках обробляємо помилку
            console.error(status, error);
        }
    });
});
const countrySelect = document.getElementById('country');
    const regionSelect = document.getElementById('region');

    const regions = {
        Україна: ["Вінницька", "Волинська", "Дніпропетровська", "Донецька", "Житомирська", "Закарпатська", "Запорізька", "Івано-Франківська", "Київська", "Кіровоградська", "Луганська", "Львівська", "Миколаївська", "Одеська", "Полтавська", "Рівненська", "Сумська", "Тернопільська", "Харківська", "Херсонська", "Хмельницька", "Черкаська", "Чернівецька", "Чернігівська", "Місто Київ", "Місто Севастополь"],
        Словаччина: ["Банськобистрицький", "Братиславський", "Кошицький", "Нітранський", "Пряшівський", "Тренчінський", "Трнавський", "Жилінський", "Місто Братислава"],
        Угорщина: ["Будапешт", "Бач-Кішкун", "Бекеш", "Боршод-Абауж-Земплен", "Чонград", "Фейер", "Дьер", "Жала", "Гьор", "Хевеш", "Йічке-Кішкун", "Комаром-Естергом", "Ноґрад", "Пешт", "Сомоги", "Сабольч-Сатмар-Берег", "Толна", "Ваш"],
        Чехія: ["Градец-Кралове", "Ліберець", "Моравосілезький", "Оломоуц", "Пардубіце", "Пльзень", "Прага", "Северо-Чеський", "Среднечеський", "Южно-Моравський", "Край Височина", "Край Южночешский", "Моравськосілезький", "Пардубицкий", "Пльзеньский", "Стредочеський", "Усті-над-Лабем", "Карловарский", "Край Пардубицкий", "Край Либерецкий", "Край Моравскослезский", "Край Оломоуцкий", "Край Пльзеньский", "Край Северо-Моравский", "Край Среднеческий", "Край Южночешский", "Злінський"]
    };

    countrySelect.addEventListener('change', function() {
        const country = this.value;
        const countryRegions = regions[country] || [];

        regionSelect.innerHTML = '<option value="">Виберіть область</option>';
        regionSelect.disabled = countryRegions.length === 0;

        countryRegions.forEach(function(region) {
            const option = document.createElement('option');
            option.value = region;
            option.textContent = region;
            regionSelect.appendChild(option);
        });
    });
    document.getElementById('euExperience').addEventListener('change', function() {
        var euExperienceQuestions = document.getElementById('euExperienceQuestions');
        if (this.value === 'Так') {
            euExperienceQuestions.style.display = 'block';
        } else {
            euExperienceQuestions.style.display = 'none';
        }
    });

</script>
@endsection