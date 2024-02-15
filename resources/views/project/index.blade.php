@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
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
    <div class="country-card" data-country="Угорщина">Угорщина</div>
    <div class="country-card" data-country="Словаччина">Словаччина</div>
    <div class="country-card" data-country="Чехія">Чехія</div>
    
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
                                        <button type="button" class="btn btn-primary details-btn" onclick="openPDFEditor()">Створити PDF</button>

                                        <div id="pdfEditorModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 9999; " >
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <h3>Редактор PDF</h3>
                                                <button type="button" onclick="closePDFEditor()">✖</button>
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
    function openPDFEditor() {
            // Відображення модального вікна
            document.getElementById('pdfEditorModal').style.display = 'block';
        }

        function closePDFEditor() {
            // Закриття модального вікна
            document.getElementById('pdfEditorModal').style.display = 'none';
        }

        function generateAndPreviewPDF() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;

            // Створення документу pdfmake
            var docDefinition = {
                content: [
                    { text: 'ALEXXQUALITYWORK', fontSize: 18, color: 'blue' },
                    { text: `Країна: ${name}`, fontSize: 12 },
                    { text: `Назва проекту: ${email}`, fontSize: 12 },
                    { text: 'ALEXXQUALITYWORK', fontSize: 14, color: 'black' }
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