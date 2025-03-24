<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Negara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Negara</h1>

        <!-- Form untuk melakukan request -->
        <form action="{{ url('/search') }}" method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control"
                        placeholder="Cari berdasarkan nama negara">
                </div>
                <div class="col-md-4">
                    <input type="text" name="code" class="form-control"
                        placeholder="Cari berdasarkan kode negara">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ url('/') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Tampilkan daftar negara -->
        <div class="row">
            @foreach ($countries as $country)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $country['name']['common'] }}</h5>
                            <p class="card-text">
                                <strong>Ibu Kota:</strong> {{ $country['capital'][0] ?? 'Tidak ada data' }}<br>
                                <strong>Populasi:</strong> {{ number_format($country['population']) }}
                            </p>
                            <a href="{{ url('/country/' . $country['name']['common']) }}"
                                class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
