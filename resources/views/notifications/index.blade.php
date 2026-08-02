<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔔 Notifikasi
        </h2>
    </x-slot>

    <div class="container py-4">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow">

            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    🔔 Daftar Notifikasi
                </h4>

                @if($notifications->where('is_read', false)->count())

                    <form action="{{ route('notifications.readAll') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <button class="btn btn-light btn-sm">

                            Tandai Semua Dibaca

                        </button>

                    </form>

                @endif

            </div>

            <div class="card-body">

                @forelse($notifications as $notification)

                    <a href="{{ route('notifications.read',$notification) }}"
                       class="list-group-item list-group-item-action mb-2 rounded
                       {{ !$notification->is_read ? 'list-group-item-warning' : '' }}">

                        <div class="d-flex justify-content-between">

                            <strong>

                                {{ $notification->title }}

                                @unless($notification->is_read)

                                    <span class="badge bg-danger ms-2">
                                        Baru
                                    </span>

                                @endunless

                            </strong>

                            <small>

                                {{ $notification->created_at->diffForHumans() }}

                            </small>

                        </div>

                        <div class="mt-2">

                            {{ $notification->message }}

                        </div>

                    </a>

                @empty

                    <div class="alert alert-info">

                        Belum ada notifikasi.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>