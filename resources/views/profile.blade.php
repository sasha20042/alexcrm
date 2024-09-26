@extends('layouts.app')

@section('title', 'Редагування профілю')

@section('contents')
    <h1 class="mb-0">Профіль</h1>
    <hr />

    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profile.update') }}">
        @csrf  <!-- Додайте CSRF-токен -->
        <div class="row">
            <!-- Ліва секція для фото -->
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="text-center">
                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Фото профілю" class="img-thumbnail" width="200">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Фото профілю" class="img-thumbnail" width="200">
                        @endif
                        <input type="file" name="photo" class="form-control mt-3">
                    </div>
                </div>
            </div>

            <!-- Права секція з полями -->
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <!-- Перша секція - Особисті дані -->
                    <div class="border-bottom pb-3 mb-3">
                        <h4>Особисті Дані</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">Логін</label>
                                <input type="text" name="name" class="form-control" placeholder="Логін" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Емейл</label>
                                <input type="email" name="email" class="form-control" placeholder="Емейл" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Особистий номер телефону</label>
                                <input type="text" name="personal_phone" class="form-control" placeholder="Номер телефону" value="{{ auth()->user()->personal_phone }}">
                            </div>
                        </div>
                    </div>

                    <!-- Друга секція - Робочі дані -->
                    <div>
                        <h4>Робочі Дані</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">Робочий номер телефону 1</label>
                                <input type="text" name="work_phone_1" class="form-control" placeholder="Робочий номер телефону 1" value="{{ auth()->user()->work_phone_1 }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Робочий номер телефону 2</label>
                                <input type="text" name="work_phone_2" class="form-control" placeholder="Робочий номер телефону 2" value="{{ auth()->user()->work_phone_2 }}">
                            </div>
                        </div>

                        <!-- Секція для соц. мереж -->
                        <div class="mt-3">
                            <h5>Соціальні Мережі</h5>
                            <div id="social-media-container">
                                <!-- Тут будуть додаватися соц. мережі -->
                            </div>
                            <button type="button" class="btn btn-secondary mt-3" id="add-social-btn">Додати соціальну мережу</button>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button id="btn" class="btn btn-primary profile-button" type="submit">Зберегти</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // JavaScript для додавання нових полів соц. мереж
        document.getElementById('add-social-btn').addEventListener('click', function() {
    const container = document.getElementById('social-media-container');
    const index = container.children.length;

    const socialMediaForm = `
        <div class="border p-3 mb-3 social-media-item">
            <div class="form-group">
                <label>Назва соц. мережі</label>
                <select name="social_media[${index}][platform]" class="form-control">
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                </select>
            </div>
            <div class="form-group">
                <label>Логін</label>
                <input type="text" name="social_media[${index}][login]" class="form-control" placeholder="Логін">
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="social_media[${index}][password]" class="form-control" placeholder="Пароль">
            </div>
            <div class="form-group">
                <label>Посилання на сторінку</label>
                <input type="text" name="social_media[${index}][link]" class="form-control" placeholder="Посилання">
            </div>
            <button type="button" class="btn btn-danger remove-social-btn">Видалити</button>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', socialMediaForm);

    // Add event listener for the remove button
    const removeButton = container.lastElementChild.querySelector('.remove-social-btn');
    removeButton.addEventListener('click', function() {
        container.removeChild(removeButton.parentElement);
    });
});

    </script>
@endsection
