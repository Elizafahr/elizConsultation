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
            <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="/applications" class="nav-link">Apptications</a></li>
            @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="  btn"  type="submit">Выйти</button>
            </form>
            @else
            <li class="nav-item"><a href="/login" class="nav-link">Log in</a></li>
            <li class="nav-item"><a href="/register" class="nav-link">Sign up</a></li>
            @endif

        </ul>
    </header>