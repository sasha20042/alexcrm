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
    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/20.1.0/css/intlTelInput.css" integrity="sha512-CwPZ5+QkF7eO5vaRmlLuHCUH6TpTdlzE4j7ndsbvguECOYG6nmkJwMK+JLFR3DCtDzGIEbC7nUPYUdK2e7bCPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://kit.fontawesome.com/b440ab2580.js" crossorigin="anonymous"></script>

<div class="container">
    <h1 class="mb-4">Додати клієнта</h1>
    <hr />

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label fs-5">ПІБ</label>
                <input type="text" name="title" class="form-control fs-6" id="title" placeholder="Введіть ПІБ" required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label fs-5">Номер телефону</label>
                <div class="input-group">
                    <input type="tel" name="phone" class="form-control fs-6" id="phone" placeholder="Номер телефону" required>
                    <select class="form-select fs-6" id="messenger" name="messenger">
                        <option value="telegram" data-icon="fab fa-telegram">Telegram</option>
                        <option value="viber" data-icon="fab fa-viber">Viber</option>
                            <option value="whatsapp" data-icon="fab fa-whatsapp">WhatsApp</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="product_code" class="form-label fs-5">Вакансія</label>
                <input type="text" name="product_code" class="form-control fs-6" id="product_code" placeholder="Введіть вакансію" required>
            </div>
            <div class="col-md-6">
                <label for="manager" class="form-label fs-5">Менеджер</label>
                <input type="text" name="manager" class="form-control fs-6" id="manager" value="{{ auth()->user()->name }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="sex" class="form-label">Стать</label>
                <select name="sex" class="form-select" id="sex" required>
                    <option value="Чоловік">Чоловік</option>
                    <option value="Жінка">Жінка</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="citizenship" class="form-label">Громадянство</label>
                <input type="text" name="citizenship" class="form-control" id="citizenship" placeholder="Громадянство" required>
            </div>
            <div class="col-md-6">
                <label for="age" class="form-label">Вік</label>
                <input type="text" name="age" class="form-control" id="age" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="description" class="form-label">Статус</label>
                <select name="description" class="form-select" id="description" required>
                    <option value="На опрацюванні">На опрацюванні</option>
                    <option value="Відправлено на роботу">Відправлено на роботу</option>
                    <option value="На резерв">На резерв</option>
                    <option value="Відмовився">Відмовився</option>
                    <option value="Уточнення">Уточнення</option>
                    <option value="Підбір вакансії">Підбір вакансії</option>
                    <option value="Ми відмовили">Ми відмовили</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="location" class="form-label">Місцезнаходження</label>
                <input type="text" name="location" class="form-control" id="location" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-check-label">Особлива Увага</label>
                <div class="form-check">
                    <input type="radio" name="blacklist" class="form-check-input" id="blacklist_yes" value="yes">
                    <label for="blacklist_yes" class="form-check-label">Так</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="blacklist" class="form-check-input" id="blacklist_no" value="no" checked>
                    <label for="blacklist_no" class="form-check-label">Ні</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- intl-tel-input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/20.1.0/js/intlTelInput.min.js" integrity="sha512-7pFvbhLztQcEePj9oGV9CKIMYsy7L9lkIpHP3/cVIKFqT5JY9WfrYXiOkLaZRWUmic/eZIamPond53lZ/liSvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- FontAwesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/20.1.0/js/utils.js" integrity="sha512-6eq826ZpWfomZeckvWDz/GGbZSCgexJafBx3yZ2AADpBakcTk2MFypyXpoia+rxb4Wcni+8t3HKp/3e6pJPeTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Ініціалізуємо intl-tel-input
    $("#phone").intlTelInput({
            preferredCountries: ["ua", "ru"], // Налаштування переваги країн
            separateDialCode: true, // Розділити код країни від номеру
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js", // Скрипт утиліт для intl-tel-input
        });

</script>
@endsection