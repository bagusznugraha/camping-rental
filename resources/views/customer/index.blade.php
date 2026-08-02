<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">
        👥 Data Pelanggan
    </h2>
</x-slot>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Daftar Pelanggan</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Total Penyewaan</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($customers as $customer)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $customer->name }}</td>

                        <td>{{ $customer->email }}</td>

                        <td>{{ $customer->rentals_count }} Kali</td>

                        <td>

                            @if($customer->rentals_count>0)

                                <span class="badge bg-success">
                                    Pernah Menyewa
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Belum Pernah Menyewa
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            Tidak ada pelanggan.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>