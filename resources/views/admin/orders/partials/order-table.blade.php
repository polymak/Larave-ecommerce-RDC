@foreach($orders as $order)
<tr class="hover:bg-gray-100">
    <td class="py-2 px-4 border-b">{{ $order->order_number }}</td>
    <td class="py-2 px-4 border-b">{{ $order->customer_name }}</td>
    <td class="py-2 px-4 border-b">{{ number_format($order->total_price, 2) }} CDF</td>
    <td class="py-2 px-4 border-b">
        <a href="{{ route('orders.edit', $order->id) }}" class="text-blue-500 hover:underline">Modifier</a>
        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
