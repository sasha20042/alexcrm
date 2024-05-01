@extends('layouts.app')

@section('title', '')

@section('contents')
    <style>
    .card {
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 15px;
    background-color: #f9f9f9;
}

.card h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

.card p {
    font-size: 16px;
    margin-bottom: 5px;
}

.card-body {
    padding: 0;
}

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/times-new-roman" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Liberation+Serif:wght@400;700&display=swap" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Виїзди</h1>
        <a href="{{ route('depart.create') }}" class="btn btn-primary">Додати виїзд</a>

    </div>
    <hr />
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        @foreach($depart as $depart)
        <div class="col-md-3">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h2 class="card-title font-weight-bold">{{ $depart->title }}</h2>
                    <p class="card-text"><strong>Кількість людей:</strong> {{ $depart->city }}</p>
                    <p class="card-text"><strong>Дата:</strong> {{ $depart->date }}</p>
                    <p class="card-text"><strong>Виїзд:</strong> {{ $depart->description }}</p>
                    <a href="{{ route('depart.edit', $depart->id) }}"> <i class="fas fa-pencil-alt float-right"></i></a>
                    <form action="{{ route('depart.destroy', $depart->id) }}" method="POST" onsubmit="return confirm('Точно видалити?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn p-0"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    

    <br>
    <br>

  

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ховаємо всі блоки крім блоків країн
            $('.country-block, .company-cards, .vacancy-card, .details-btn').hide();

            $(document).on('click', '.country-card', function() {
                var countryId = $(this).data('country');

                // Ховаємо всі блоки крім блоків компаній в обраній країні
                $('.country-block').hide();
                $('#' + countryId).show();

                // Ховаємо всі блоки крім блоків компаній
                $('.company-cards').hide();

                // Показуємо блок компаній в обраній країні
                $('#' + countryId + ' .company-cards').show();

                // Ховаємо всі блоки вакансій та кнопок "Детальніше"
                $('.details-btn').show();
            });

            $(document).on('click', '.details-btn', function() {
                var index = $(this).data('index');

                // Ховаємо всі блоки вакансій
                $('.vacancy-card').hide();

                // Показуємо вакансії для обраної компанії
                $('.vacancy-card[data-index="' + index + '"]').show();
            });
        });

 
    </script>
    


@endsection
