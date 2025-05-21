<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

</head>

<body>
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
           
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="  btn"  type="submit">Выйти</button>
            </form>
          

        </ul>
    </header>
<h1> Админ панель</h1>
 
        @if (Auth::check())
        <h2>Заявки</h2>
      <table class="table">
        <thead>
        <td>ФИО</td>
        <td>Тип</td>
        <td>дата</td>
        <td>статус</td>
        <td> </td>
        </thead>
      @foreach($app as $application)
<tr>
<td>{{ $application->user->name }} {{$application->user->surname}}   {{$application->user->patronymic }}</td>
<td>{{ $application->service->title }}</td>
    <td>{{ $application->date }}</td>
    <td>{{ $application->status->title ?? 'Неизвестный статус' }}</td>
    <td>
        <form action="{{ route('admin.updateStatus', $application->id) }}" method="POST">
            @csrf
            @method('PUT')
            <select name="status_id" onchange="this.form.submit()">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $status->id == $application->status_id ? 'selected' : '' }}>
                        {{ $status->title }}
                    </option>
                @endforeach
            </select>
        </form>
    </td>
</tr>
@endforeach
      </table>


        @else
        <h2>Авторизуйтесь, чтобы посмотреть заказы</h2>
        @endif