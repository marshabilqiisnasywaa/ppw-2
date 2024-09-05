<!-- resources/views/home.blade.php -->

<!--berarti view yang sedang kita buat (misalnya home.blade.php) 
akan menggunakan layout yang berada di 
resources/views/layouts/app.blade.php 
sebagai kerangka dasar tampilan.-->
@extends('layouts.app')


@section('title', 'Home Page')

@section('header', 'Home')

@section('content')
    <p>This is the home page content.</p>
@endsection
