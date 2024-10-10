<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

        <title>{{ config('app.name', 'Session - 23530 - Admin') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @vite(['resources/css/bleu-admin.css', 'resources/js/bleu-admin.js'])
        <link rel="stylesheet" href="{{ asset('css/bleu-admin.min.css') }}">

    </head>
    <body id="page-top" style="background-color: #f8f9fc">
      <div id="wrapper">
          @include('layouts.bleu-sidebar')
        <main id="content-wrapper" class="d-flex flex-column mt-3" >
          <div id="content">
            {{ $slot }}
          </div>
        </main>
      </div>
    </body>
</html>