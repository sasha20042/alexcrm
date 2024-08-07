@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<link rel="preconnect" href="https://fonts.gstatic.com">
<!-- Підключення jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Підключення DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">

<!-- Підключення DataTables JavaScript -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700&family=Work+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    body {
    font-family: 'Work Sans', sans-serif;
}

h1, h2, h3 {
    font-family: 'Work Grotesk', sans-serif;
}
     .action-icons .btn {
        padding: 0.2rem;
        font-size: 1.2rem;
        line-height: 1;
        border-radius: 0.25rem;
    }

    .action-icons .btn i {
        margin-right: 0.2rem;
    }

    .action-icons .btn.btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .action-icons .btn.btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .action-icons .btn.btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .action-icons .btn.btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 0.25rem;
        overflow: hidden;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .align-middle {
        vertical-align: middle !important;
    }

    .gender-icon {
        font-size: 1.3rem;
    }
    .name-column{
        width: 260px;
        

    }
    .gender-column {
        width: 60px;
    }

    .flag-icon {
        font-size: 1.2rem;
        margin-right: 5px;
    }
</style>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

<!-- jQuery (необхідний для DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>


    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Кандидати</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Додати Кандидата</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table id="datatable" class="table table-striped table-bordered" style="color: black;">
        <thead class="table-primary">
            <tr>
                <th>№</th>
                <th>Дата</th>
                <th class="name-column text-center">Прізвище Ім'я</th>
                <th class="text-center">Телефон</th>
                <th>Вік</th>
                <th class="gender-column text-center">Ч/Ж</th>
                <th class="text-center">Місцезнаходження</th>
                <th class="text-center">Громадянство</th>
                <th class="text-center">Вакансія</th>
                <th class="text-center">Менеджер</th>
                <th class="text-center">Статус</th>
                <th>Дія</th>
            </tr>
        </thead>
        <tbody>
            @if($products->count() > 0)
                @foreach($products as $rs)
                <tr>
                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center">{{ $rs->created_at->format('d.m.y') }}</td>
                    <td class="align-middle text-center"  onmousedown="if(event.button !== 2) window.location='{{ route('products.edit', $rs->id) }}';">
                        @if($rs->blacklist == 'yes')
                            <span style="color: red; font-weight: bold; font-size: 20px;">!</span>
                        @endif
                        {{ $rs->title }}
                    </td>
                    <td class="align-middle text-center" style="font-size: 85%">
                        
                        {{ $rs->price }}
                        <a href="viber://chat?number={{ $rs->price }}" target="_blank">
                            <i class="fab fa-viber" style="color: #665cac;"></i>
                        </a>
                    </td>
                    <td class="align-middle text-center" style="{{ $rs->age > 55 ? 'color: red;' : '' }}">{{ $rs->age }}</td>
                    <td class="align-middle text-center">
                        @if($rs->sex == 'Чоловік')
                            <i class="fas fa-male gender-icon" style="color: blue;"></i>
                        @elseif($rs->sex == 'Жінка')
                            <i class="fas fa-female gender-icon" style="color: rgb(246, 25, 62);"></i>
                        @endif
                    </td>
                    <td class="align-middle text-center">
                        {{ $rs->location }}
                    </td>
                    <td class="align-middle text-center">{{ $rs->citizenship }}</td>
                    <td class="align-middle text-center">{{ $rs->product_code }}</td>
                    <td class="align-middle text-center">{{ $rs->manager }}</td>
                    <td class="align-middle text-center">
                        @if($rs->description == 'На опрацюванні')
                            <span class="badge bg-primary py-2 px-2 text-white">{{ $rs->description }}</span>
                        @elseif($rs->description == 'Відправлено на роботу' || $rs->description == 'На оформленні' )
                            <span class="badge bg-success py-2 px-2 text-white">{{ $rs->description }}</span>
                        @elseif($rs->description == 'На резерв')
                            <span class="badge bg-warning py-2 px-2 text-white">{{ $rs->description }}</span>
                        @elseif($rs->description == 'Відмовився')
                            <span class="badge bg-danger py-2 px-2 text-white">{{ $rs->description }}</span>
                        @elseif($rs->description == 'Уточнення')
                            <span class="badge bg-info py-2 px-2">{{ $rs->description }}</span>
                        @elseif($rs->description == 'Підбір вакансії')
                            <span class="badge bg-secondary py-2 px-2">{{ $rs->description }}</span>
                        @endif
                    </td>
                    <td class="align-middle action-icon text-center">
                        <form action="{{ route('products.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Точно видалити?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn p-0"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="12">Не знайдено</td>
                </tr>
            @endif
        </tbody>
    </table>
    
    
    <script>
     
 
let table = new DataTable('#datatable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/uk.json',
    },
    responsive: true
});


    </script>
    
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