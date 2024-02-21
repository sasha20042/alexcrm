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
             border: 1px solid #ccc;
             margin-bottom: 20px;
             padding: 10px;
             background-color: #f8f9fa;
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
     background-color: #f8f9fa;
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
    
    @foreach(['Угорщина', 'Словаччина', 'Чехія'] as $country)
    <div class="country-block" id="{{ $country }}">
        <h2>{{ $country }}</h2>
        <div class="company-cards">
            @foreach($project->where('country', $country) as $rs)
                <div class="card company-card" style="" data-country="{{ $country }}" data-company="{{ $rs->company }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $rs->company }}</h5>
                        <p class="card-text">{{ $rs->city }}</p>
                        <div class="vacancy-cards">
                            @foreach($project->where('company', $rs->company) as $vacancy)
                                <div class="card vacancy-card" style="margin: 10px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $vacancy->vacancy }}</h5>
                                        <p class="card-text">{{ $vacancy->job }}</p> 
                                        <button type="button" class="btn btn-primary details-btn" onclick="openPDFEditor('{{ $vacancy->id }}')">Створити PDF</button>

                                        <div id="pdfEditorModal_{{ $vacancy->id }}" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 9999; ">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <h3>Редактор PDF</h3>
                                                <button type="button" onclick="closePDFEditor('{{ $vacancy->id }}')">✖</button>
                                            </div>
                                            <hr>
                                            <div style="display: flex;" >
                                                <div id="pdfPreview" style="margin-right: 20px; border: 1px solid #ccc;  "></div>
                                                <div>
                                                    <label for="name">Країна</label>
                                                    <input type="text" id="name" required>
                                                    <br>
                                                    <label for="email">Назва проекту\заводу</label>
                                                    <input type="email" id="email" required>
                                                    <br>
                                                    <button type="button" onclick="generateAndPreviewPDF()">Створити і Переглянути PDF</button>
                                                    <br> <br>
                                                    <button type="button" onclick="downloadPDF()">Завантажити PDF</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            @endforeach
                        </div> 
                        <button class="btn btn-secondary details-btn">Детальніше</button> <br>
                    </div>
                </div> <br>
            @endforeach
        </div>
    </div>
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Ховаємо всі блоки крім блоків країн
        $('.country-block, .company-cards, .vacancy-card, .details-btn').hide();

        $('.country-card').on('click', function(){
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
    // Ховаємо всі блоки вакансій
    $('.vacancy-card').hide();

    // Показуємо вакансії для обраної компанії
    $(this).closest('.company-card').find('.vacancy-card').show();
    }); 
    });
    function openPDFEditor(vacancyId) {
    document.getElementById('pdfEditorModal_' + vacancyId).style.display = 'block';
}

function closePDFEditor(vacancyId) {
    document.getElementById('pdfEditorModal_' + vacancyId).style.display = 'none';
}


function generateAndPreviewPDF() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;

            // Створення документу pdfmake
            var docDefinition = {
    pageOrientation: 'portrait',
    pageSize: 'A4',
    pageMargins: [0, 0, 0, 0],
    content: [
        {
            canvas: [
                { type: 'rect', x: 0, y: 0, w: 595.28, h: 841.89, color: '#F9F3E4' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 20 },
            columns: [
                {
                    width: 'auto',
                    text: 'flag1',
                    alignment: 'left'
                },
                {
                    width: '*',
                    text: 'ALEXXQUALITYWORK',
                    fontSize: 18,
                    color: 'blue',
                    alignment: 'center'
                },
                {
                    width: 'auto',
                    text: 'flag2',
                    alignment: 'right'
                }
            ]
        },
        {
            absolutePosition: { x: 10, y: 40 },
            canvas: [
                { type: 'line', x1: 0, y1: 0, x2: 575.28, y2: 0, lineWidth: 2, lineColor: 'gold' }
            ]
        },
        {
            absolutePosition: { x: 10, y: 60 },
            text: 'НАЗВА КРАЇНИ - НАЗВА КОМПАНІЇ',
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
                `${name} (Місце роботи)`,
                `${email} (Назва професії)`,
                'Обмеження щодо статі та віку',
                {
                    text: 'Короткі відомості',
                    ul: [
                        'Наявність змін на виробництві',
                        'Кількість робочих годин',
                        'Заробітна плата'
                    ]
                },
                {
                    text: 'Умови проживання',
                    ul: [
                        'Умова 1',
                        'Умова 2',
                        'Умова 3'
                    ]
                }
            ],
            fontSize: 12
        },
        {
            absolutePosition: { x: 10, y: 200 },
            text: 'ALEXXQUALITYWORK'
        }
    ]
};


            // Створення PDF документу і отримання Blob
            pdfMake.createPdf(docDefinition).getBlob((blob) => {
                // Відображення PDF у вбудованому фреймі
                var url = URL.createObjectURL(blob);
                var pdfViewer = document.getElementById('pdfPreview');
                pdfViewer.innerHTML = `<iframe width="500" height="500" src="${url}" frameborder="0"></iframe>`;
            });
        }

        function downloadPDF() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;

            // Створення документу pdfmake
            var docDefinition = {
                content: [
                    { text: 'Мій PDF Заголовок', fontSize: 18, color: 'blue' },
                    { text: `Ім'я: ${name}`, fontSize: 12 },
                    { text: `Електронна пошта: ${email}`, fontSize: 12 },
                    { text: 'Мій PDF Підпис', fontSize: 14, color: 'black' }
                ]
            };

            // Створення PDF документу і вивантаження
            pdfMake.createPdf(docDefinition).download('my_pdf');
        }
</script>



@endsection