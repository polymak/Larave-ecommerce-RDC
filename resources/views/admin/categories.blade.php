@extends('layout')

@section('title', 'Gérer les Catégories')

@section('content')
    <h2 class="text-2xl mb-4">Catégories</h2>
    <a href="{{ route('admin.category.create') }}" class="bg-green-500 text-white rounded p-2">Ajouter une Catégorie</a>
    <!-- Liste des catégories ici -->
@endsection
