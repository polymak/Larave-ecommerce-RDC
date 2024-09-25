@extends('layouts.app')

@section('title', 'Profil de l\'utilisateur')

@section('content')
<div class="container mx-auto mt-10 px-4">
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-3xl mx-auto p-10">
        <h1 class="text-4xl font-bold mb-6 text-center">Mon Profil</h1>

        <div class="flex justify-between mb-8">
            <a href="{{ route('profile.edit', $user->id) }}" class="flex-1 bg-blue-500 text-white text-center p-4 rounded-md shadow-lg hover:shadow-xl transition-shadow duration-200">
                Modifier Profil
            </a>
            <a href="{{ url('profile/orders') }}" class="flex-1 bg-green-500 text-white text-center p-4 rounded-md shadow-lg hover:shadow-xl transition-shadow duration-200 ml-4">
                Voir Mes Commandes
            </a>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold">Informations de Client</h2>
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
        </div>

    </div>
</div>
@endsection
