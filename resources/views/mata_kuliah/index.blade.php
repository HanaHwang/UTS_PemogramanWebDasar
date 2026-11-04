<link rel="stylesheet" />
<div>
    <div>
        <h3>Daftar Mata Kuliah</h3>
        <a href="{{ route('mata-kuliah.create') }}">+ Tambah Mata Kuliah</a>
    </div>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @forelse($mataKuliah as $index =&gt; $mk)
    @empty
    @endforelse
    <table>
        <thead>
            <tr>
            <th>No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody><tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $mk-&gt;kode }}</td>
            <td>{{ $mk-&gt;nama }}</td>
            <td>{{ $mk-&gt;sks }}</td>
            <td>
                <a href="{{ route('mata-kuliah.edit', $mk-&gt;id) }}">Edit</a>
            </td>
        </tr><tr>
            <td colspan="5">Belum ada data mata kuliah.</td>
        </tr></tbody>
    </table>
</div>