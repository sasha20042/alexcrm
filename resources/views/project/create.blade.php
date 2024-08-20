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

        #newCompanyFields {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .img-flag {
            width: 20px;
            height: 15px;
            margin-right: 10px;
        }

        .iti__flag {
            background-size: contain;
        }
    </style>

    <!-- Підключення бібліотеки country-select-js -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/country-select-js@2.0.3/build/js/countrySelect.min.js"></script>
    <link rel="stylesheet" href="build/css/countrySelect.css">
    
    <div class="container">
        <h1 class="mb-4">Додати Проект</h1>
        <hr />

        <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-half">
                    <label for="countrySelect" class="form-label">Країна:</label>
                    <input type="text" id="countrySelect" name="country" class="form-control" required>
                   
                </div>
                
                <div class="col-half">
                    <label for="companySelect" class="form-label">Агенція:</label>
                    <select name="company_select" id="companySelect" class="form-select">
                        <option value="">Виберіть агенцію</option>
                        <option value="new">Додати нову агенцію</option>
                    </select>
                </div>
            </div>

            <div id="newCompanyFields" style="display: none;">
                <div class="row mb-3">
                    <div class="col-full">
                        <label for="newCompanyName" class="form-label">Назва нової агенції:</label>
                        <input type="text" name="new_company" id="newCompanyName" class="form-control" placeholder="Назва нової агенції">

                    </div>
                    <div class="col-full">
                        <label for="newCompanyCity" class="form-label">Місце розташування агенції:</label>
                        <input type="text" name="new_company_city" id="newCompanyCity" class="form-control" placeholder="Місце розташування">
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
                                <input type="text" name="contact_phone[]" class="form-control contactPhone" placeholder="Номер телефону">
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

            <div id="jobDetailsFields" style="display: none;">
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="cityInput" class="form-label">Місто вакансії:</label>
                        <input type="text" name="city" id="cityInput" class="form-control" placeholder="Місто">
                    </div>
                    <div class="col-half">
                        <label for="jobInput" class="form-label">Назва роботи:</label>
                        <input type="text" name="job" id="jobInput" class="form-control" placeholder="Робота">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-half">
                        <label for="vacancyInput" class="form-label">Завод:</label>
                        <input type="text" name="vacancy" id="vacancyInput" class="form-control" placeholder="Завод">
                    </div>
                </div>
            </div>
            <input type="hidden" id="selectedCompany" name="company">
            <div class="col-full">
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.1.1/js/countrySelect.js" integrity="sha512-Bpc5Io2V3sZf10nkbHAfih9VJlxbj1IBcFvNXIZy3RBuuxXbnnX8fsksEuZ6LJ/P1GFhinF+HUhw6BIrGteDCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.1.1/css/countrySelect.css" integrity="sha512-WPc1lYhwI/V+DbzjPRw98rLrQznhpPZ7C/d7K6Vc5s7Sxw2zEk4xLodZwPP0SQ3aLJsBbuaYF0iovbFs2zzKlw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script>
        $(document).ready(function() {
            // Ініціалізація countrySelect
           
    
            // Завантаження агенцій
            $.ajax({
            url: '/api/fetch-companies',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var companySelect = $('#companySelect');
                var existingOptions = companySelect.find('option').map(function() {
                    return $(this).text();
                }).get();
                
                $.each(response, function(index, company) {
                    if (existingOptions.indexOf(company.company) === -1) {
                        companySelect.append('<option value="'+company.company+'">'+company.company+'</option>');
                        existingOptions.push(company.company);
                    }
                });
            }
        });
            
    
            $('#companySelect').on('change', function () {
                var selectedOption = $(this).val();
                if (selectedOption === 'new') {
                    $('#newCompanyFields').show();
                    $('#jobDetailsFields').show();
                } else if (selectedOption) {
                    $('#jobDetailsFields').show();
                    $('#newCompanyFields').hide();
                } else {
                    $('#jobDetailsFields').hide();
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
                                <input type="text" name="contact_phone[]" class="form-control contactPhone" placeholder="Номер телефону">
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
        $('#countrySelect').countrySelect({
                defaultCountry: "hu", // Встановити Україну як країну за замовчуванням
                responsiveDropdown: true,
                preferredCountries: ['hu', 'cz', 'sk']
            });
            $('form').on('submit', function() {
            var selectedOption = $('#companySelect').val();
            if (selectedOption === 'new') {
                $('#selectedCompany').val($('#newCompanyName').val());
            } else {
                $('#selectedCompany').val(selectedOption);
            }
        });
    </script>
   
@endsection
