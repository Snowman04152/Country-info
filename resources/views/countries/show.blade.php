<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Negara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">{{ $country['name']['common'] }}</h1>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Ibu Kota:</strong> {{ $country['capital'][0] ?? 'Tidak ada data' }}</p>
                <p><strong>Populasi:</strong> {{ number_format($country['population']) }}</p>
                <p><strong>Region:</strong> {{ $country['region'] }}</p>
                <p><strong>Subregion:</strong> {{ $country['subregion'] ?? 'Tidak ada data' }}</p>
                <p><strong>Bahasa:</strong>
                    @if (isset($country['languages']))
                        {{ implode(', ', array_values($country['languages'])) }}
                    @else
                        Tidak ada data
                    @endif
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ $country['flags']['png'] }}" alt="Bendera {{ $country['name']['common'] }}" class="img-fluid">
            </div>
        </div>
        <a href="{{ url('/') }}" class="btn btn-secondary mt-4">Kembali</a>
    </div>
</body>
</html>