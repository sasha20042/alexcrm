@extends('layouts.app')

@section('title')

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
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
            max-width: 900px;
        }

        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        hr {
            border-color: #007bff;
            margin-bottom: 30px;
        }

        .form-label {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        textarea.form-control {
            resize: vertical;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 12px 30px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-add-contact {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-block {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .contact-block h4 {
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .col-half, .col-full {
            flex: 0.48;
        }

        .col-contacts {
            flex: 1;
        }
    </style>

    <div class="container">
        <h1 class="mb-4">Додати Проект</h1>
        <hr />

        <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-half">
                    <label for="countrySelect" class="form-label">Країна:</label>
                    <br>
                    <select name="country" id="countrySelect" required class="form-select">
                        <option value="Угорщина">Угорщина</option>
                        <option value="Словаччина">Словаччина</option>
                        <option value="Чехія">Чехія</option>
                    </select>
                </div>
                <div class="col-half">
                    <label for="cityInput" class="form-label">Місто:</label>
                    <input type="text" name="city" id="cityInput" class="form-control" placeholder="Місто">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-half">
                    <label for="jobInput" class="form-label">Робота:</label>
                    <input type="text" name="job" id="jobInput" class="form-control" placeholder="Робота">
                </div>
                <div class="col-half">
                    <label for="vacancyInput" class="form-label">Завод:</label>
                    <input type="text" name="vacancy" id="vacancyInput" class="form-control" placeholder="Завод">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-half">
                    <label for="companySelect" class="form-label">Компанія:</label>
                    <select name="company_id" id="companySelect" class="form-select">
                        <option value="">Виберіть компанію</option>
                        <option value="new">Додати нову</option>
                    </select>
                </div>
            </div>

            <div id="newCompanyFields" style="display: none;">
                <div class="row mb-3">
                    <div class="col-full">
                        <label for="newCompanyName" class="form-label">Назва нової компанії:</label>
                        <input type="text" name="new_company_name" id="newCompanyName" class="form-control" placeholder="Назва нової компанії">
                    </div>
                </div>

                <div id="contactBlocks">
                    <div class="contact-block">
                        <h4>Контакти</h4>
                        <div class="row mb-3">
                            <div class="col-half">
                                <label for="contactName" class="form-label">Ім'я:</label>
                                <input type="text" name="contact_name[]" class="form-control" placeholder="Ім'я">
                            </div>
                            <div class="col-half">
                                <label for="contactPhone" class="form-label">Номер телефону:</label>
                                <input type="text" name="contact_phone[]" class="form-control" placeholder="Номер телефону">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-half">
                                <label for="contactEmail" class="form-label">Емейл:</label>
                                <input type="email" name="contact_email[]" class="form-control" placeholder="Емейл">
                            </div>
                            <div class="col-half">
                                <label for="contactPosition" class="form-label">Посада:</label>
                                <input type="text" name="contact_position[]" class="form-control" placeholder="Посада">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-add-contact">+ Додати ще одного контакта</button>
            </div>

            <div class="col-full">
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: '/api/fetch-companies',
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    console.log(response);

                    var companySelect = $('#companySelect');
                    $.each(response, function(index, company){
                        companySelect.append('<option value="'+company.id+'">'+company.company+'</option>');
                    });
                }
            });

            $('#companySelect').on('change', function () {
                var selectedOption = $(this).val();
                if (selectedOption === 'new') {
                    $('#newCompanyFields').show();
                } else {
                    $('#newCompanyFields').hide();
                }
            });

            $('.btn-add-contact').on('click', function () {
                var newContactBlock = `
                    <div class="contact-block">
                        <h4>Контакти</h4>
                        <div class="row mb-3">
                            <div class="col-half">
                                <label for="contactName" class="form-label">Ім'я:</label>
                                <input type="text" name="contact_name[]" class="form-control" placeholder="Ім'я">
                            </div>
                            <div class="col-half">
                                <label for="contactPhone" class="form-label">Номер телефону:</label>
                                <input type="text" name="contact_phone[]" class="form-control" placeholder="Номер телефону">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-half">
                                <label for="contactEmail" class="form-label">Емейл:</label>
                                <input type="email" name="contact_email[]" class="form-control" placeholder="Емейл">
                            </div>
                            <div class="col-half">
                                <label for="contactPosition" class="form-label">Посада:</label>
                                <input type="text" name="contact_position[]" class="form-control" placeholder="Посада">
                            </div>
                        </div>
                    </div>
                `;
                $('#contactBlocks').append(newContactBlock);
            });
        });
    </script>

@endsection
