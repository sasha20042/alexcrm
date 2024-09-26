@extends('layouts.app')

@section('title', 'Команда')

@section('contents')

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">

<style>
    body {
        font-family: 'Work Sans', sans-serif;
    }
    h1 {
        font-family: 'Work Grotesk', sans-serif;
        color: #343a40;
        margin-bottom: 30px;
    }

    /* Оформлення плиток */
    .manager-tile {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .manager-tile:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        background-color: #e9ecef;
    }

    .manager-info {
        margin-bottom: 10px;
    }

    .manager-email {
        font-size: 16px;
        font-weight: 600;
        color: #007bff;
    }

    /* Стилі для модального вікна */
    .modal-header {
        background-color: #007bff;
        color: white;
    }

    .modal-body {
        font-size: 14px;
    }

    .modal-footer {
        border-top: none;
    }
</style>
<!-- У секції <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Перед закриваючим тегом </body> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
<div class="container">
    <h1>Команда</h1>
    <div class="row">
        @if($team->count() > 0)
            @foreach($team as $rs)
            <div class="col-md-4">
                <div class="manager-tile" data-bs-toggle="modal" data-bs-target="#managerModal{{ $rs->id }}">
                    <div class="manager-info">
                        <h3>{{ $rs->name }}</h3>
                        <p class="manager-email">{{ $rs->email }}</p>
                    </div>
                </div>

                <!-- Модальне вікно -->
                <div class="modal fade" id="managerModal{{ $rs->id }}" tabindex="-1" aria-labelledby="managerModalLabel{{ $rs->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="managerModalLabel{{ $rs->id }}">{{ $rs->name }} - Профіль</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Особистий номер телефону:</strong> {{ $rs->personal_phone }}</p>
                                <p><strong>Робочий номер телефону 1:</strong> {{ $rs->work_phone_1 }}</p>
                                <p><strong>Робочий номер телефону 2:</strong> {{ $rs->work_phone_2 }}</p>
                                <p><strong>Адреса:</strong> {{ $rs->address }}</p>
                                <p><strong>Фото:</strong></p>
                                @if ($rs->photo)
                                    <img src="{{ asset('storage/' . $rs->photo) }}" alt="Фото профілю" class="img-thumbnail" width="150">
                                @else
                                    <img src="https://via.placeholder.com/150" alt="Фото профілю" class="img-thumbnail" width="150">
                                @endif
                                <h5 class="mt-3">Соціальні мережі</h5>
                                @if ($rs->social_media)
                                    @php $socials = json_decode($rs->social_media); @endphp
                                    @foreach ($socials as $social)
                                        <p><strong>{{ $social->platform }}:</strong> {{ $social->link }}</p>
                                    @endforeach
                                @else
                                    <p>Соціальні мережі не вказані.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12">
                <p>Менеджери не знайдені</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Додаткова логіка для модальних вікон
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('.modal');

        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Кнопка, яка відкриває модальне вікно
                const managerName = button.querySelector('h3').innerText; // Ім'я менеджера
                const modalTitle = modal.querySelector('.modal-title');
                
                // Задаємо заголовок модального вікна
                modalTitle.innerText = managerName + ' - Профіль';
            });
        });
    });
</script>

@endsection
