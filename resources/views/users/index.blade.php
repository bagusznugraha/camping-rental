<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">
        👥 Data User
    </h2>
</x-slot>

<div class="container py-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Daftar User</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>

                            @if($user->role=="admin")

                                <span class="badge bg-danger">
                                    Admin
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Pelanggan
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $user->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            Belum ada user.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>