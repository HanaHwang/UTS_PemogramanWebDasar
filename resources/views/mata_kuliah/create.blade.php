<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mata Kuliah</title>
    <link href="[suspicious link removed]" rel="stylesheet">
</head>

<body class="p-4 bg-light">
    <div class="container bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
        <h4>Tambah Mata Kuliah</h4>
        <form action="{{ route('mata-kuliah.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode MK</label>
                <input type="text" name="kode" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah SKS</label>
                <input type="number" name="sks" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>