@extends('layouts.app')
  
@section('title', '')
  
@section('contents')

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Список</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Додати клієнта</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover" style="color: black;" >
        <thead class="table-primary">
            <tr>
                <th>№</th>
                <th>ПІБ</th>
                <th>Громадянство</th>
                <th>Стать</th>
                <th>Вік</th>
                <th>Телефон</th>
                <th>Місцезнаходження</th>
                <th>Вакансія</th>
                <th>Менеджер</th>
                <th>Стан</th>
                <th>Дія</th>
            </tr>
        </thead>
        <tbody>
            @if($product->count() > 0)
                @foreach($product as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="align-middle">{{ $rs->citizenship }}</td>
                        <td class="align-middle">{{ $rs->sex }}</td>
                        <td class="align-middle" id="ageDisplay">{{ $rs->age }}</td>
                        <td class="align-middle">{{ $rs->price }}</td>
                        <td class="align-middle">{{ $rs->location }}</td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                         <td class="align-middle">{{ $rs->manager }}</td>
                         <td class="align-middle">{{ $rs->description }}</td>  
                         
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary">Деталі</a>
                                <a href="{{ route('products.edit', $rs->id)}}" type="button" class="btn btn-warning">Змінити</a>
                                <form action="{{ route('products.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Точно видалити?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Видалити</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Не знайдено</td>
                </tr>
            @endif
        </tbody>
    </table>
    <script>
        // Отримуємо елемент, в якому відображається вік
        var ageDisplay = document.getElementById('ageDisplay');

// Перевіряємо, чи елемент існує перед отриманням властивості textContent
if (ageDisplay) {
    // Отримуємо дату народження з текстового контенту елемента
    var birthdate = new Date(ageDisplay.textContent);

    // Отримуємо поточну дату
    var currentDate = new Date();

    // Обчислюємо вік
    var age = currentDate.getFullYear() - birthdate.getFullYear();

    // Перевіряємо, чи вже відбувся день народження у поточному році
    if (currentDate.getMonth() < birthdate.getMonth() || (currentDate.getMonth() === birthdate.getMonth() && currentDate.getDate() < birthdate.getDate())) {
        age--;
    }

    // Відображаємо вік у елементі
    ageDisplay.textContent = age ;
}
    </script>
@endsection