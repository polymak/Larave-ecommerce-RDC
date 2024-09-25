@foreach($users as $user)
<tr class="hover:bg-gray-100">
    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
    <td class="py-2 px-4 border-b">
        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline">Modifier</a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
