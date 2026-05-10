@extends('layouts.admin')

@section('content')
    <div class="page-title">Manajemen Siswa</div>

    <div class="table-card">
        <div class="table-header">
            <h2><i class="fa-solid fa-users"></i> Daftar Akun Siswa</h2>
            <span class="table-count">{{ $siswa->count() }} data</span>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                <th>NIS</th>
                <th>NISN</th> 
                <th>Nama Siswa</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr>
                        <td><strong>{{ $s->nis }}</strong></td>
                <td>{{ $s->nisn }}</td> <td><div class="student-name">{{ $s->nama }}</div></td>
                <td><div class="student-meta">{{ $s->gmail }}</div></td>
                <td>
                    <form action="/admin/siswa/{{ $s->nis }}" method="POST" onsubmit="return confirm('Hapus siswa ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection