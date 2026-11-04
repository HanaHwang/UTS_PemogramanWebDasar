<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kehadiran Mahasiswa</title>
    <link href="[suspicious link removed]" rel="stylesheet">
    <style>
        body{
            background-color: #f8f9fa;
        }

        .table th, .table td{
            vertical-align: middle;
        }

        .badge-hadir{
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .badge-absen{
            background-color: #f8d7da;
            color: #842029;
        }

        .badge-izin{
            background-color: #fff3cd;
            color: #664d03;
        }

        .badge-sakit{
            background-color: #cff4fc;
            color: #055160;
        }

        .radio-group label{
            margin-left: 10px;
            cursor: pointer;
            font-weight: 500;
        }
    </style>
</head>

<body class="py-4">
    <div class="container bg-white p-4 rounded shadow-sm">
        <h4 class="mb-4 fw-bold">Daftar Kehadiran Mahasiswa</h4>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{
                session('success')
            }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        @endif

        <form method="GET" action="{{ route('absensi.index') }}" class="row g-3 mb-4 p-3 bg-light rounded border">
            <div class="col-md-4">
                <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ $selectedDate }}" class="form-control" onchange="this.form.submit()">
            </div>

            <div class="col-md-6">
                <label for="mata_kuliah_id" class="form-label fw-bold">Nama Mata Kuliah</label>
                <select id="mata_kuliah_id" name="mata_kuliah_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($mataKuliahList as $mk)
                        <option value="{{ $mk->id }}" {{ $selectedMkId == $mk->id ? 'selected' : '' }}>{{ $mk->kode }} - {{ $mk->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100">Tampilkan</button>
            </div>
        </form>

        @if($selectedMkId)
        <form method="POST" action="{{ route('absensi.store') }}">
            @csrf
            <input type="hidden" name="mata_kuliah_id" value="{{ $selectedMkId }}">
            <input type="hidden" name="tanggal" value="{{ $selectedDate }}">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Mahasiswa</th>
                            <th>Kehadiran</th>
                            <th class="text-end" style="width: 200px;">Status<br>
                                <small class="text-muted fw-normal">H &nbsp;&nbsp; A &nbsp;&nbsp; I &nbsp;&nbsp; S</small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $index => $mhs)
                            @php
                                $status = isset($existingAbsensi[$mhs->id]) ? $existingAbsensi[$mhs->id]->status : null;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-uppercase">{{ $mhs->nama }}</div>
                                    <div class="text-muted small">{{ $mhs->nim }}</div>
                                </td>
                                <td>
                                    @if($status === 'H')<span class="badge badge-hadir">HADIR</span>
                                    @elseif($status === 'A')<span class="badge badge-absen">ABSEN</span>
                                    @elseif($status === 'I')<span class="badge badge-izin">IZIN</span>
                                    @elseif($status === 'S')<span class="badge badge-sakit">SAKIT</span>
                                    @else<span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-end radio-group">
                                    <label><input type="radio" name="status[{{ $mhs->id }}]" value="H" {{ $status === 'H' || is_null($status) ? 'checked' : '' }}> H</label>
                                    <label><input type="radio" name="status[{{ $mhs->id }}]" value="A" {{ $status === 'A' ? 'checked' : '' }}> A</label>
                                    <label><input type="radio" name="status[{{ $mhs->id }}]" value="I" {{ $status === 'I' ? 'checked' : '' }}> I</label>
                                    <label><input type="radio" name="status[{{ $mhs->id }}]" value="S" {{ $status === 'S' ? 'checked' : '' }}> S</label>
                                </td>
                            </tr>
                            @empty
                            
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada data mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary px-4">Simpan Absensi</button>
            </div>
        </form>
        @else
            <div class="alert alert-info text-center py-4">Silakan pilih <strong>Nama Mata Kuliah</strong> dan <strong>Tanggal</strong> di atas untuk melihat atau mengisi kehadiran.</div>
        @endif
    </div>
    <script src="[suspicious link removed]"></script>
</body>
</html>