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
<!-- intl-tel-input CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/20.1.0/css/intlTelInput.css" integrity="sha512-CwPZ5+QkF7eO5vaRmlLuHCUH6TpTdlzE4j7ndsbvguECOYG6nmkJwMK+JLFR3DCtDzGIEbC7nUPYUdK2e7bCPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://kit.fontawesome.com/b440ab2580.js" crossorigin="anonymous"></script>

    <div class="container">
        <h3 class="mb-4">Додавай кандидата, {{ auth()->user()->name }}</h3> 
        <hr />
    
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="manager" class="form-control fs-6" id="manager" value="{{ auth()->user()->name }}" readonly>
            
            <div class="row">
                <div class="col-md-6 border-end">
                    
        
                        <div class="mb-3">
                            <label for="title" class="form-label fs-5">Прізвище Ім'я </label>
                            <input type="text" name="title" class="form-control fs-6" id="title" placeholder="Введіть ПІБ" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="price" class="form-label fs-5 "><i class="fab fa-viber"></i> Номер телефону</label>
                            <div class="input-group">
                                <span class="input-group-text" style="height: 38px;">+</span>
                                <input type="tel" name="price" class="form-control fs-6" id="price" placeholder="Основний Номер телефону" required>
                               
                            </div>
                        </div>
                        
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label fs-5 "> Додатковий Номер телефону</label>
                            <div class="input-group">
                                <span class="input-group-text" style="height: 38px;">+</span>
                                <input type="tel" name="phone" class="form-control fs-6" id="phone" placeholder="Додатковий Номер телефону" >
                                <select class="form-select mb-2" id="social_media" name="social_media" style="max-width: 150px;">
                                    <option value="Viber">
                                        <i class="fab fa-viber"></i> Viber
                                    </option>
                                    <option value="WhatsApp">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </option>
                                    <option value="Telegram">
                                        Telegram
                                    </option>
                                </select>
                            </div>
                        </div>
        
                        <div class="mb-3">
                            <label for="sex" class="form-label fs-5">Стать</label>
                            <select name="sex" class="form-select" id="sex" required>
                                <option value="Чоловік">Чоловік</option>
                                <option value="Жінка">Жінка</option>
                            </select>
                        </div>
        
                        <div class="mb-3">
                            <label for="age" class="form-label fs-5">Вік</label>
                            <input type="text" name="age" class="form-control fs-6" id="age" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="citizenship" class="form-label fs-5">Громадянство</label>
                            <input type="text" name="citizenship" class="form-control fs-6" id="citizenship" placeholder="Громадянство" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="location" class="form-label fs-5">Місцезнаходження</label>
                            <input type="text" name="location" class="form-control fs-6" id="location" required>
                        </div>
                    </form>
                </div>
        
                <div class="col-md-6 border-end">
                   
                    <div class="mb-3">
                        <label for="product_code" class="form-label fs-5">Вакансія</label>
                        <select name="product_code" class="form-select fs-6" id="product_code" required>
                            <option value=""></option>
                        </select>
                    </div>
                    
                    
        
                        <div class="mb-3">
                            <label for="interaction_source" class="form-label fs-5">Джерело взаємодії</label>
                            <input type="text" name="interaction_source" class="form-control fs-6" id="interaction_source" placeholder="Джерело взаємодії" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="description" class="form-label fs-5">Статус</label>
                            <select name="description" class="form-select fs-6" id="description" required>
                                <option value="На опрацюванні">На опрацюванні</option>
                                <option value="Відправлено на роботу">Відправлено на роботу</option>
                                <option value="На резерв">На резерв</option>
                                <option value="Відмовився">Відмовився</option>
                                <option value="Уточнення">Уточнення</option>
                                <option value="Підбір вакансії">Підбір вакансії</option>
                                <option value="Ми відмовили">Ми відмовили</option>
                            </select>
                        </div>
        
                        
        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Додати</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- intl-tel-input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/20.1.0/js/intlTelInput.min.js" integrity="sha512-7pFvbhLztQcEePj9oGV9CKIMYsy7L9lkIpHP3/cVIKFqT5JY9WfrYXiOkLaZRWUmic/eZIamPond53lZ/liSvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- FontAwesome JS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/20.1.0/js/utils.js" integrity="sha512-6eq826ZpWfomZeckvWDz/GGbZSCgexJafBx3yZ2AADpBakcTk2MFypyXpoia+rxb4Wcni+8t3HKp/3e6pJPeTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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


</script>
@endsection