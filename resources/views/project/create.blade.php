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
                        <label for="status" class="form-label">Статус:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="active">Активний</option>
                            <option value="inactive">Не активний</option>
                        </select>
                    </div>
            
                    
                </div>
            
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="vacancy" class="form-label">Назва проекту/заводу:</label>
                        <input type="text" name="vacancy" id="vacancy" class="form-control" placeholder="Назва проекту/заводу">
                    </div>
            
                    <div class="col-half">
                        <label for="factorySpecialization" class="form-label">Спеціалізація заводу:</label>
                        <input type="text" name="factorySpecialization" id="factorySpecialization" class="form-control" placeholder="Спеціалізація заводу">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="city" class="form-label">Місце роботи:</label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Місце роботи">
                    </div>
            
                    <div class="col-half">
                        <label for="job" class="form-label">Назва професії:</label>
                        <input type="text" name="job" id="job" class="form-control" placeholder="Назва професії">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="genderAgeRestrictions" class="form-label">Обмеження щодо статі та віку:</label>
                        <input type="text" name="genderAgeRestrictions" id="genderAgeRestrictions" class="form-control" placeholder="Обмеження щодо статі та віку">
                    </div>
            
                    <div class="col-half">
                        <label for="shortDetails" class="form-label">Короткі відомості:</label>
                        <textarea name="shortDetails" id="shortDetails" class="form-control" placeholder="Короткі відомості"></textarea>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="productionChanges" class="form-label">Наявність змін на виробництві:</label>
                        <input type="text" name="productionChanges" id="productionChanges" class="form-control" placeholder="Наявність змін на виробництві">
                    </div>
            
                    <div class="col-half">
                        <label for="workingHours" class="form-label">Кількість робочих годин:</label>
                        <input type="text" name="workingHours" id="workingHours" class="form-control" placeholder="Кількість робочих годин">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="salary" class="form-label">Заробітна плата:</label>
                        <textarea name="salary" id="salary" class="form-control" placeholder="Заробітна плата"></textarea>
                    </div>
            
                    <div class="col-half">
                        <label for="accommodationConditions" class="form-label">Умови проживання:</label>
                        <textarea name="accommodationConditions" id="accommodationConditions" class="form-control" placeholder="Умови проживання"></textarea>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="mealConditions" class="form-label">Умови харчування:</label>
                        <textarea name="mealConditions" id="mealConditions" class="form-control" placeholder="Умови харчування"></textarea>
                    </div>
            
                    <div class="col-half">
                        <label for="transportation" class="form-label">Транспортування:</label>
                        <input type="text" name="transportation" id="transportation" class="form-control" placeholder="Транспортування">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-half">
                        <label for="additionalExpenses" class="form-label">Додаткові витрати:</label>
                        <input type="text" name="additionalExpenses" id="additionalExpenses" class="form-control" placeholder="Додаткові витрати">
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
