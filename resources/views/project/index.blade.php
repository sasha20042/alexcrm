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

                                <div id="pdfEditorModal_{{ $vacancy->id }}" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f7f7f7; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); z-index: 9999; max-width: calc(800px + 5%); overflow-y: hidden; max-height: 80vh;">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <h3 style="color: #333;">Редактор PDF</h3>
                                        <button type="button" onclick="closePDFEditor('{{ $vacancy->id }}')" style="background-color: #333; color: #fff; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;">✖ Закрити</button>
                                    </div>
                                    <hr style="border-top: 1px solid #ddd; margin-bottom: 15px;">
                                    <div style="display: flex; flex-wrap: wrap; overflow-y: auto;">
        <!-- Додаємо блок для відображення PDF -->
        <div id="pdfContainer_{{ $vacancy->id }}" style="flex: 1; margin-right: 20px; border: 1px solid #ddd; border-radius: 5px; padding: 10px; background-color: #fff;"></div>
        <div style="flex: 1; max-height: 60vh; overflow-y: auto; margin-right: 20px;">
            <!-- Ваша форма тут -->
            <label for="statusInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Статус:</label>
            <input type="text" id="statusInput_{{ $vacancy->id }}" placeholder="Активний, прихований, видалений" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="countryInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Країна:</label>
            <input type="text" id="countryInput_{{ $vacancy->id }}" placeholder="Угорщина, Чехія, Словаччина" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="projectNameInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Назва проекту/заводу:</label>
            <input type="text" id="projectNameInput_{{ $vacancy->id }}" placeholder="Назва проекту/заводу" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="factorySpecializationInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Спеціалізація заводу:</label>
            <input type="text" id="factorySpecializationInput_{{ $vacancy->id }}" placeholder="Спеціалізація заводу" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="workLocationInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Місце роботи:</label>
            <input type="text" id="workLocationInput_{{ $vacancy->id }}" placeholder="Місце роботи" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="jobTitleInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Назва професії:</label>
            <input type="text" id="jobTitleInput_{{ $vacancy->id }}" placeholder="Назва професії" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="genderAgeRestrictionsInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Обмеження щодо статі та віку:</label>
            <input type="text" id="genderAgeRestrictionsInput_{{ $vacancy->id }}" placeholder="Обмеження щодо статі та віку" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="shortDetailsInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Короткі відомості:</label>
            <textarea id="shortDetailsInput_{{ $vacancy->id }}" placeholder="Короткі відомості" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;"></textarea>

            <label for="productionChangesInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Наявність змін на виробництві:</label>
            <input type="text" id="productionChangesInput_{{ $vacancy->id }}" placeholder="Наявність змін на виробництві" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="workingHoursInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Кількість робочих годин:</label>
            <input type="text" id="workingHoursInput_{{ $vacancy->id }}" placeholder="Кількість робочих годин" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="salaryInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Заробітна плата:</label>
            <input type="text" id="salaryInput_{{ $vacancy->id }}" placeholder="Заробітна плата" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="accommodationConditionsInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Умови проживання:</label>
            <input type="text" id="accommodationConditionsInput_{{ $vacancy->id }}" placeholder="Умови проживання" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="mealConditionsInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Умови харчування:</label>
            <input type="text" id="mealConditionsInput_{{ $vacancy->id }}" placeholder="Умови харчування" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="transportationInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Транспортування:</label>
            <input type="text" id="transportationInput_{{ $vacancy->id }}" placeholder="Транспортування" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <label for="additionalExpensesInput" style="color: #333; font-weight: bold; margin-bottom: 5px;">Додаткові витрати:</label>
            <input type="text" id="additionalExpensesInput_{{ $vacancy->id }}" placeholder="Додаткові витрати" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">

            <br>
            <button type="button" onclick="generatePDF('{{ $vacancy->id }}')" style="background-color: #333; color: #fff; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer; margin-top: 10px;">Згенерувати PDF</button>
            <br><br>
            <button type="button" onclick="downloadPDFButton('{{ $vacancy->id }}')" style="background-color: #333; color: #fff; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;">Завантажити PDF</button>
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
    const base64Image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAApgAAAKYB3X3/OAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAANCSURBVEiJtZZPbBtFFMZ/M7ubXdtdb1xSFyeilBapySVU8h8OoFaooFSqiihIVIpQBKci6KEg9Q6H9kovIHoCIVQJJCKE1ENFjnAgcaSGC6rEnxBwA04Tx43t2FnvDAfjkNibxgHxnWb2e/u992bee7tCa00YFsffekFY+nUzFtjW0LrvjRXrCDIAaPLlW0nHL0SsZtVoaF98mLrx3pdhOqLtYPHChahZcYYO7KvPFxvRl5XPp1sN3adWiD1ZAqD6XYK1b/dvE5IWryTt2udLFedwc1+9kLp+vbbpoDh+6TklxBeAi9TL0taeWpdmZzQDry0AcO+jQ12RyohqqoYoo8RDwJrU+qXkjWtfi8Xxt58BdQuwQs9qC/afLwCw8tnQbqYAPsgxE1S6F3EAIXux2oQFKm0ihMsOF71dHYx+f3NND68ghCu1YIoePPQN1pGRABkJ6Bus96CutRZMydTl+TvuiRW1m3n0eDl0vRPcEysqdXn+jsQPsrHMquGeXEaY4Yk4wxWcY5V/9scqOMOVUFthatyTy8QyqwZ+kDURKoMWxNKr2EeqVKcTNOajqKoBgOE28U4tdQl5p5bwCw7BWquaZSzAPlwjlithJtp3pTImSqQRrb2Z8PHGigD4RZuNX6JYj6wj7O4TFLbCO/Mn/m8R+h6rYSUb3ekokRY6f/YukArN979jcW+V/S8g0eT/N3VN3kTqWbQ428m9/8k0P/1aIhF36PccEl6EhOcAUCrXKZXXWS3XKd2vc/TRBG9O5ELC17MmWubD2nKhUKZa26Ba2+D3P+4/MNCFwg59oWVeYhkzgN/JDR8deKBoD7Y+ljEjGZ0sosXVTvbc6RHirr2reNy1OXd6pJsQ+gqjk8VWFYmHrwBzW/n+uMPFiRwHB2I7ih8ciHFxIkd/3Omk5tCDV1t+2nNu5sxxpDFNx+huNhVT3/zMDz8usXC3ddaHBj1GHj/As08fwTS7Kt1HBTmyN29vdwAw+/wbwLVOJ3uAD1wi/dUH7Qei66PfyuRj4Ik9is+hglfbkbfR3cnZm7chlUWLdwmprtCohX4HUtlOcQjLYCu+fzGJH2QRKvP3UNz8bWk1qMxjGTOMThZ3kvgLI5AzFfo379UAAAAASUVORK5CYII=';
    const basee64Image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAApgAAAKYB3X3/OAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAANCSURBVEiJtZZPbBtFFMZ/M7ubXdtdb1xSFyeilBapySVU8h8OoFaooFSqiihIVIpQBKci6KEg9Q6H9kovIHoCIVQJJCKE1ENFjnAgcaSGC6rEnxBwA04Tx43t2FnvDAfjkNibxgHxnWb2e/u992bee7tCa00YFsffekFY+nUzFtjW0LrvjRXrCDIAaPLlW0nHL0SsZtVoaF98mLrx3pdhOqLtYPHChahZcYYO7KvPFxvRl5XPp1sN3adWiD1ZAqD6XYK1b/dvE5IWryTt2udLFedwc1+9kLp+vbbpoDh+6TklxBeAi9TL0taeWpdmZzQDry0AcO+jQ12RyohqqoYoo8RDwJrU+qXkjWtfi8Xxt58BdQuwQs9qC/afLwCw8tnQbqYAPsgxE1S6F3EAIXux2oQFKm0ihMsOF71dHYx+f3NND68ghCu1YIoePPQN1pGRABkJ6Bus96CutRZMydTl+TvuiRW1m3n0eDl0vRPcEysqdXn+jsQPsrHMquGeXEaY4Yk4wxWcY5V/9scqOMOVUFthatyTy8QyqwZ+kDURKoMWxNKr2EeqVKcTNOajqKoBgOE28U4tdQl5p5bwCw7BWquaZSzAPlwjlithJtp3pTImSqQRrb2Z8PHGigD4RZuNX6JYj6wj7O4TFLbCO/Mn/m8R+h6rYSUb3ekokRY6f/YukArN979jcW+V/S8g0eT/N3VN3kTqWbQ428m9/8k0P/1aIhF36PccEl6EhOcAUCrXKZXXWS3XKd2vc/TRBG9O5ELC17MmWubD2nKhUKZa26Ba2+D3P+4/MNCFwg59oWVeYhkzgN/JDR8deKBoD7Y+ljEjGZ0sosXVTvbc6RHirr2reNy1OXd6pJsQ+gqjk8VWFYmHrwBzW/n+uMPFiRwHB2I7ih8ciHFxIkd/3Omk5tCDV1t+2nNu5sxxpDFNx+huNhVT3/zMDz8usXC3ddaHBj1GHj/As08fwTS7Kt1HBTmyN29vdwAw+/wbwLVOJ3uAD1wi/dUH7Qei66PfyuRj4Ik9is+hglfbkbfR3cnZm7chlUWLdwmprtCohX4HUtlOcQjLYCu+fzGJH2QRKvP3UNz8bWk1qMxjGTOMThZ3kvgLI5AzFfo379UAAAAASUVORK5CYII=';
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