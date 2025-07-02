<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Notifikasi</h2>
    </x-slot>
    <div class="py-6 max-w-3xl mx-auto">
        @foreach($notifications->groupBy(function($item) { return $item->created_at->format('Y-m-d'); }) as $date => $items)
            <div class="mb-6">
                <div class="font-bold text-lg mb-2">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</div>
                @foreach($items as $notification)
                    <div class="flex justify-between items-center p-4 mb-2 rounded {{ $notification->read_at ? 'bg-gray-100' : 'bg-blue-50' }}">
                        <div>
                            <div class="font-semibold">{{ $notification->data['title'] ?? '-' }}</div>
                            <div class="text-gray-600">{{ $notification->data['message'] ?? '-' }}</div>
                            <div class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                        @if(!$notification->read_at)
                        <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                            @csrf
                            <x-primary-button>Tandai Sudah Dibaca</x-primary-button>
                        </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
        {{ $notifications->links() }}
    </div>
</x-app-layout>