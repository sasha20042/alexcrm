@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<style>
     .country-card {
        display: inline-block;
        margin-right: 10px;
        padding: 10px 40px 10px 20px;
        background-color: #3498db;
        color: #fff;
        cursor: pointer;
        border-radius: 5px;
        position: relative;
    }

    .country-card img {
        width: 20px;
        height: auto;
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .country-card span {
        position: relative;
        padding-left: 30px; /* Збільште це значення відповідно до вашого вигляду */
    }

    .country-card:hover {
        background-color: #2980b9;
    }
    .country-block {
            
             margin-bottom: 20px;
             padding: 10px;
             background-color: #f8f9fa00;
         }
 
         /* Оформлення для кнопок країн */
         .country-btn {
             background-color: #007bff;
             color: #fff;
             border: none;
             padding: 10px;
             cursor: pointer;
             margin-right: 10px;
         }
 
         /* Оформлення для блоку компаній */
         .company-cards {
             display: flex;
             flex-wrap: wrap;
             gap: 10px;
             margin-top: 10px;
         }
 
         /* Оформлення для блоку компанії */
         .company-card {
             border: 1px solid #ccc;
             padding: 10px;
             background-color: #fff;
             line-height: 1.2; /* Зменшення інтервалу між текстовими елементами */
             overflow: hidden; /* Заборона виділення за межі блоку */
             margin-right: 10px;
         }
 
         /* Оформлення для блоку вакансій */
         .vacancy-cards {
             display: flex;
             flex-wrap: wrap;
             gap: 10px;
             margin-top: 10px;
         }
 
         /* Оформлення для блоку вакансії */
         .vacancy-card {
     display: none;  /* Додайте цей стиль для приховання вакансій за замовчуванням */
     border: 1px solid #ccc;
     padding: 10px;
     background-color: #f4faff;
     line-height: 1.2; /* Зменшення інтервалу між текстовими елементами */
     overflow: hidden; /* Заборона виділення за межі блоку */
     margin-right: 10px;
 }
 </style>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Проекти</h1>
        <a href="{{ route('project.create') }}" class="btn btn-primary">Додати проект</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="country-card" data-country="Угорщина">
        <img src="{{ asset('admin_assets/img/hungary.png') }}" alt="Угорщина Прапор">
        <span>Угорщина</span>
    </div>
    
    <div class="country-card" data-country="Словаччина">
        <img src="{{ asset('admin_assets/img/slovakia.png') }}" alt="Словаччина Прапор">
        <span>Словаччина</span>
    </div>
    
    <div class="country-card" data-country="Чехія">
        <img src="{{ asset('admin_assets/img/czech-republic.png') }}" alt="Чехія Прапор">
        <span>Чехія</span>
    </div>
    
    <br>
    <br>
    
    @php
        $uniqueCountries = $project->pluck('country')->unique();
    @endphp
    
    @foreach($uniqueCountries as $country)
        <div class="country-block" id="{{ $country }}">
           
            <div class="company-cards">
                @php
                    $uniqueCompanies = $project->where('country', $country)->pluck('company')->unique();
                @endphp
    
                @foreach($uniqueCompanies as $companyIndex => $company)
                    <div class="card company-card" data-country="{{ $country }}" data-company="{{ $company }}">
                        <!-- Ваш код для компаній -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $company }}</h5>
                            <p class="card-text">{{ $project->where('country', $country)->where('company', $company)->first()->city }}</p>
                            <button class="btn btn-secondary details-btn" data-index="{{ $companyIndex }}">Детальніше</button>
                        </div>
                    </div>
                @endforeach
            </div>
                <hr  style="border-color: gold;">
            <div class="vacancy-cards" id="{{ $country }}" style="display: none;">
                @foreach($uniqueCompanies as $companyIndex => $company)
                    @php
                        $vacancies = $project->where('country', $country)->where('company', $company);
                    @endphp
    
                    @foreach($vacancies as $vacancyIndex => $vacancy)
                        <div class="card vacancy-card" style="margin: 10px; display: none;" data-index="{{ $companyIndex }}">
                            <!-- Ваш код для вакансій -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $vacancy->vacancy }}</h5>
                                <p class="card-text">{{ $vacancy->job }}</p> 
                                <button type="button" class="btn btn-primary" onclick="openPDFEditor('{{ $vacancy->id }}')">Створити PDF</button>

                                <div id="pdfEditorModal_{{ $vacancy->id }}" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 9999; ">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <h3>Редактор PDF</h3>
                                        <button type="button" onclick="closePDFEditor('{{ $vacancy->id }}')">✖</button>
                                    </div>
                                    <hr>
                                       <div style="display: flex;">
                                           <!-- Додаємо блок для відображення PDF -->
                                           <div id="pdfContainer_{{ $vacancy->id }}"></div>
                                           <div>
                                           <br>
                                        
                                            <label for="statusInput">Статус:</label>
                                            <input type="text" id="statusInput_{{ $vacancy->id }}" placeholder="Активний, прихований, видалений">
                                            <br>
                                        
                                            <label for="countryInput">Країна:</label>
                                            <input type="text" id="countryInput_{{ $vacancy->id }}" placeholder="Угорщина, Чехія, Словаччина">
                                            <br>
                                        
                                            <label for="projectNameInput">Назва проекту/заводу:</label>
                                            <input type="text" id="projectNameInput_{{ $vacancy->id }}" placeholder="Назва проекту/заводу">
                                            <br>
                                        
                                            <label for="factorySpecializationInput">Спеціалізація заводу:</label>
                                            <input type="text" id="factorySpecializationInput_{{ $vacancy->id }}" placeholder="Спеціалізація заводу">
                                            <br>
                                        
                                            <label for="workLocationInput">Місце роботи:</label>
                                            <input type="text" id="workLocationInput_{{ $vacancy->id }}" placeholder="Місце роботи">
                                            <br>
                                        
                                            <label for="jobTitleInput">Назва професії:</label>
                                            <input type="text" id="jobTitleInput_{{ $vacancy->id }}" placeholder="Назва професії">
                                            <br>
                                        
                                            <label for="genderAgeRestrictionsInput">Обмеження щодо статі та віку:</label>
                                            <input type="text" id="genderAgeRestrictionsInput_{{ $vacancy->id }}" placeholder="Обмеження щодо статі та віку">
                                            <br>
                                        
                                            <label for="shortDetailsInput">Короткі відомості:</label>
                                            <textarea id="shortDetailsInput_{{ $vacancy->id }}" placeholder="Короткі відомості"></textarea>
                                            <br>
                                        
                                            <label for="productionChangesInput">Наявність змін на виробництві:</label>
                                            <input type="text" id="productionChangesInput_{{ $vacancy->id }}" placeholder="Наявність змін на виробництві">
                                            <br>
                                        
                                            <label for="workingHoursInput">Кількість робочих годин:</label>
                                            <input type="text" id="workingHoursInput_{{ $vacancy->id }}" placeholder="Кількість робочих годин">
                                            <br>
                                        
                                            <label for="salaryInput">Заробітна плата:</label>
                                            <input type="text" id="salaryInput_{{ $vacancy->id }}" placeholder="Заробітна плата">
                                            <br>
                                        
                                            <label for="accommodationConditionsInput">Умови проживання:</label>
                                            <input type="text" id="accommodationConditionsInput_{{ $vacancy->id }}" placeholder="Умови проживання">
                                            <br>
                                        
                                            <label for="mealConditionsInput">Умови харчування:</label>
                                            <input type="text" id="mealConditionsInput_{{ $vacancy->id }}" placeholder="Умови харчування">
                                            <br>
                                        
                                            <label for="transportationInput">Транспортування:</label>
                                            <input type="text" id="transportationInput_{{ $vacancy->id }}" placeholder="Транспортування">
                                            <br>
                                        
                                            <label for="additionalExpensesInput">Додаткові витрати:</label>
                                            <input type="text" id="additionalExpensesInput_{{ $vacancy->id }}" placeholder="Додаткові витрати">
                                            <br>
                                        
                                           
                                            <br>
                                            <button type="button" onclick="generatePDF('{{ $vacancy->id }}')">Згенерувати PDF</button>
                                            <br> <br>
                                            <button type="button" onclick="downloadPDFButton('{{ $vacancy->id }}')">Завантажити PDF</button>
                                        </div>
                                        </div>
                                       
                                    
                                </div>
                            </div> 
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
      $(document).ready(function(){
            // Ховаємо всі блоки крім блоків країн
            $('.country-block, .company-cards, .vacancy-card, .details-btn').hide();
    
            $(document).on('click', '.country-card', function(){
                var countryId = $(this).data('country');
    
                // Ховаємо всі блоки крім блоків компаній в обраній країні
                $('.country-block').hide();
                $('#'+countryId).show();
    
                // Ховаємо всі блоки крім блоків компаній
                $('.company-cards').hide();
    
                // Показуємо блок компаній в обраній країні
                $('#'+countryId+' .company-cards').show();
    
                // Ховаємо всі блоки вакансій та кнопок "Детальніше"
                $('.details-btn').show();
            });
    
            $(document).on('click', '.details-btn', function(){
                var index = $(this).data('index');
    
                // Ховаємо всі блоки вакансій
                $('.vacancy-card').hide();
    
                // Показуємо вакансії для обраної компанії
                $('.vacancy-card[data-index="'+index+'"]').show();
            }); 
        });
    function openPDFEditor(vacancyId) {
    document.getElementById('pdfEditorModal_' + vacancyId).style.display = 'block';
}

function closePDFEditor(vacancyId) {
    document.getElementById('pdfEditorModal_' + vacancyId).style.display = 'none';
}


function generatePDF(vacancyId) {
    // Код для генерації PDF за допомогою PDFmake
    // Приклад: https://pdfmake.github.io/docs/
    // Потрібно додати логіку для генерації та відображення PDF у блоку з id `pdfContainer_${vacancyId}`
    
    
    var country = document.getElementById(`countryInput_${vacancyId}`).value;
    var projectName = document.getElementById(`projectNameInput_${vacancyId}`).value;
    //var factorySpecialization = document.getElementById(`factorySpecializationInput_${vacancyId}`).value;
    var workLocation = document.getElementById(`workLocationInput_${vacancyId}`).value;
    var jobTitle = document.getElementById(`jobTitleInput_${vacancyId}`).value;
    var genderAgeRestrictions = document.getElementById(`genderAgeRestrictionsInput_${vacancyId}`).value;
    var shortDetails = document.getElementById(`shortDetailsInput_${vacancyId}`).value;
    var productionChanges = document.getElementById(`productionChangesInput_${vacancyId}`).value;
    var workingHours = document.getElementById(`workingHoursInput_${vacancyId}`).value;
    var salary = document.getElementById(`salaryInput_${vacancyId}`).value;
    var accommodationConditions = document.getElementById(`accommodationConditionsInput_${vacancyId}`).value;
    var mealConditions = document.getElementById(`mealConditionsInput_${vacancyId}`).value;
    var transportation = document.getElementById(`transportationInput_${vacancyId}`).value;
    var additionalExpenses = document.getElementById(`additionalExpensesInput_${vacancyId}`).value;
    const base64Image = '';
    var docDefinition = {
    pageOrientation: 'portrait',
    pageSize: 'A4',
    pageMargins: [0, 0, 0, 0],
    header: function(currentPage, pageCount, pageSize) {
        return [
            { image: base64Image, height: 50, width: 500, alignment: 'center'}
        ]
    },
    footer: function(currentPage, pageCount, pageSize) {
        return [
            { image: basee64Image, height: 30, width: 100 }
        ]
    },  
       
    content: [
        {
            canvas: [
                { type: 'rect', x: 0, y: 0, w: 595.28, h: 841.89, color: '#f9f3e3' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 50 },
            canvas: [
                { type: 'line', x1: 0, y1: 0, x2: 575.28, y2: 0, lineWidth: 2, lineColor: 'gold' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 60 },
            text: `${country} - ${projectName}`,
            fontSize: 14,
            alignment: 'center',
            bold: true
        },
        {
            absolutePosition: { x: 10, y: 80 },
            canvas: [
                { type: 'line', x1: 0, y1: 0, x2: 575.28, y2: 0, lineWidth: 2, lineColor: 'gold' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 100 },
            ul: [
                `МІСЦЕ РОБОТИ: ${workLocation}`,
                `НАЗВА ПРОФЕСІЇ: ${jobTitle}`,
                `ОБМЕЖЕННЯ ЩОДО СТАТІ ТА ВІКУ: ${genderAgeRestrictions}`,
                `КОРОТКІ ВІДОМОСТІ: ${shortDetails}`,
                `НАЯВНІСТЬ ЗМІН НА ВИРОБНИЦТВІ: ${productionChanges}`,
                `КІЛЬКІСТЬ РОБОЧИХ ГОДИН: ${workingHours}`,
                `ЗАРОБІТНА ПЛАТА: ${salary}`,
                `УМОВИ ПРОЖИВАННЯ: ${accommodationConditions}`,
                `УМОВИ ХАРЧУВАННЯ: ${mealConditions}`,
                `ТРАНСПОРТУВАННЯ: ${transportation}`,
                `ДОДАТКОВІ ВИТРАТИ: ${additionalExpenses}`  
            ],
            fontSize: 20
        }
    ]
};

    

    // Або якщо ви хочете вставити PDF у вказаний контейнер:
    pdfMake.createPdf(docDefinition).getBlob((blob) => {
        var pdfContainer = document.getElementById(`pdfContainer_${vacancyId}`);
        pdfContainer.innerHTML = '<iframe width="500" height="600" name="plugin" src="' + URL.createObjectURL(blob) + '" type="application/pdf">';
    });

}
function downloadPDF(vacancyId) {
    
     //var status = document.getElementById(`statusInput_${vacancyId}`).value;
     var country = document.getElementById(`countryInput_${vacancyId}`).value;
    var projectName = document.getElementById(`projectNameInput_${vacancyId}`).value;
    //var factorySpecialization = document.getElementById(`factorySpecializationInput_${vacancyId}`).value;
    var workLocation = document.getElementById(`workLocationInput_${vacancyId}`).value;
    var jobTitle = document.getElementById(`jobTitleInput_${vacancyId}`).value;
    var genderAgeRestrictions = document.getElementById(`genderAgeRestrictionsInput_${vacancyId}`).value;
    var shortDetails = document.getElementById(`shortDetailsInput_${vacancyId}`).value;
    var productionChanges = document.getElementById(`productionChangesInput_${vacancyId}`).value;
    var workingHours = document.getElementById(`workingHoursInput_${vacancyId}`).value;
    var salary = document.getElementById(`salaryInput_${vacancyId}`).value;
    var accommodationConditions = document.getElementById(`accommodationConditionsInput_${vacancyId}`).value;
    var mealConditions = document.getElementById(`mealConditionsInput_${vacancyId}`).value;
    var transportation = document.getElementById(`transportationInput_${vacancyId}`).value;
    var additionalExpenses = document.getElementById(`additionalExpensesInput_${vacancyId}`).value;
   
    const base64Image = '';
    var docDefinition = {
    pageOrientation: 'portrait',
    pageSize: 'A4',
    pageMargins: [0, 0, 0, 0],
    header: function(currentPage, pageCount, pageSize) {
        return [
            { image: base64Image, height: 50, width: 500, alignment: 'center'}
        ]
    },
    footer: function(currentPage, pageCount, pageSize) {
        return [
            { image: basee64Image, height: 30, width: 100 }
        ]
    },  
       
    content: [
        {
            canvas: [
                { type: 'rect', x: 0, y: 0, w: 595.28, h: 841.89, color: '#ffffff' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 50 },
            canvas: [
                { type: 'line', x1: 0, y1: 0, x2: 575.28, y2: 0, lineWidth: 2, lineColor: 'gold' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 60 },
            text: `${country} - ${projectName}`,
            fontSize: 14,
            alignment: 'center',
            bold: true
        },
        {
            absolutePosition: { x: 10, y: 80 },
            canvas: [
                { type: 'line', x1: 0, y1: 0, x2: 575.28, y2: 0, lineWidth: 2, lineColor: 'gold' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 100 },
            ul: [
                `МІСЦЕ РОБОТИ: ${workLocation}`,
                `НАЗВА ПРОФЕСІЇ: ${jobTitle}`,
                `ОБМЕЖЕННЯ ЩОДО СТАТІ ТА ВІКУ: ${genderAgeRestrictions}`,
                `КОРОТКІ ВІДОМОСТІ: ${shortDetails}`,
                `НАЯВНІСТЬ ЗМІН НА ВИРОБНИЦТВІ: ${productionChanges}`,
                `КІЛЬКІСТЬ РОБОЧИХ ГОДИН: ${workingHours}`,
                `ЗАРОБІТНА ПЛАТА: ${salary}`,
                `УМОВИ ПРОЖИВАННЯ: ${accommodationConditions}`,
                `УМОВИ ХАРЧУВАННЯ: ${mealConditions}`,
                `ТРАНСПОРТУВАННЯ: ${transportation}`,
                `ДОДАТКОВІ ВИТРАТИ: ${additionalExpenses}`  
            ],
            fontSize: 20
        }
    ]
};


    pdfMake.createPdf(docDefinition).download(`Вакансія_${vacancyId}.pdf`);
}

// Додайте цю функцію в HTML для кнопки "Завантажити PDF"
function downloadPDFButton(vacancyId) {
    downloadPDF(vacancyId);
}
    
</script>



@endsection