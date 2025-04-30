@include('header')

@if (Auth::check())
<h1>Заявки</h1>

<table class="border table">
    <tr>
        <th>Услуга</th>
        <th>Дата</th>
        <!-- <th>Статус</th> -->
    </tr>

    @foreach($app as $application)
    <tr>
        <td>{{ $application->service->title }}</td>
        <td>{{ $application->date }}</td>
        <!-- <td>{{ $application->status->title ?? 'Неизвестный статус' }}</td> -->
    </tr>
    @endforeach
</table>
<a href="/applicaion/add">Создать заказ<< /a>
        @else
        <h1>Авторизуйтесь, чтобы посмотреть заказы</h1>
        @endif