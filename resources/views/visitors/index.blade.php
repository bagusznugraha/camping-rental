<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">
        🚶 Data Pengunjung
    </h2>
</x-slot>

<div class="container py-4">
    <div class="row mb-4">

    <div class="col-md-3">
        <div class="card text-white bg-success shadow">
            <div class="card-body text-center">
                <h6>Hari Ini</h6>
                <h2>{{ $todayVisitors }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-primary shadow">
            <div class="card-body text-center">
                <h6>Minggu Ini</h6>
                <h2>{{ $weekVisitors }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning shadow">
            <div class="card-body text-center">
                <h6>Bulan Ini</h6>
                <h2>{{ $monthVisitors }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger shadow">
            <div class="card-body text-center">
                <h6>Tahun Ini</h6>
                <h2>{{ $yearVisitors }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">
    <h4 class="mb-0">Daftar Pengunjung</h4>
</div>

<div class="card-body">

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Role</th>
    <th>Tanggal</th>
    <th>Jam</th>
</tr>
</thead>

<tbody>

@forelse($visitors as $visitor)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $visitor->visitor_name }}</td>

<td>{{ ucfirst($visitor->role) }}</td>

<td>{{ $visitor->visit_date }}</td>

<td>{{ $visitor->visit_time }}</td>

</tr>

@empty

<tr>
<td colspan="5" class="text-center">
Belum ada data pengunjung.
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</x-app-layout>