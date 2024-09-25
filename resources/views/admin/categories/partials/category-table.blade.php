@foreach($categories as $category)
<tr class="hover:bg-gray-100">
    <td class="py-2 px-4 border-b">{{ $category->name }}</td>
    <td class="py-2 px-4 border-b">
        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:underline">Modifier</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
