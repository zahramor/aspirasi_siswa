<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Aspirasi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 0; padding: 0; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 3px solid black; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 12px; }
        
        .title { text-align: center; text-decoration: underline; font-weight: bold; font-size: 14px; margin-bottom: 15px; }
        
        .meta-info { margin-bottom: 10px; font-size: 11px; }

        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th { background-color: #f2f2f2; border: 1px solid black; padding: 5px; text-align: center; }
        td { border: 1px solid black; padding: 5px; vertical-align: top; word-wrap: break-word; }
        
        .img-cell { text-align: center; }
        .img-cell img { width: 60px; height: 60px; object-fit: cover; border-radius: 2px; }
        
        .status-selesai { color: green; font-weight: bold; }
        .status-proses { color: orange; font-weight: bold; }
        
        .signature-wrapper { margin-top: 30px; float: right; width: 250px; text-align: center; }
        .signature-space { height: 60px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Pemerintah Daerah</h1>
        <h1>SMKM 2 KOTA BEKASI</h1>
        <p>Jl. Lapangan Bola Rawa Butun, Kelurahan Ciketing Udik, Kecamatan Bantargebang, Kota Bekasi, Jawa Barat, Kode Pos 17153. Telp. (021) 000000</p>
    </div>

    <div class="title">LAPORAN DATA ASPIRASI SISWA</div>

    <div class="meta-info">
        Total Data : {{ $aspirasi->count() }}<br>
        Tanggal Cetak : {{ date('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">Tanggal</th>
                <th width="12%">Nama</th>
                <th width="8%">Kelas</th>
                <th width="10%">NIS</th>
                <th width="15%">Aspirasi</th>
                <th width="10%">Kategori</th>
                <th width="10%">Bukti Awal</th>
                <th width="10%">Bukti Selesai</th>
                <th width="8%">Status</th>
                <th width="14%">Tanggapan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aspirasi as $key => $a)
            @php
                $status = $a->tanggapan->status ?? 'Belum';
            @endphp
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($a->tgl_input)->format('Y-m-d') }}</td>
                <td>{{ $a->siswa->nama }}</td>
                <td>{{ $a->siswa->kelas ?? '-' }}</td>
                <td>{{ $a->nis }}</td>
                <td>{{ $a->ket }}</td>
                <td>{{ $a->kategori->ket_kategori ?? 'Umum' }}</td>
                <td class="img-cell">
                    @if($a->foto)
                        <img src="{{ public_path('uploads/'.$a->foto) }}">
                    @else
                        -
                    @endif
                </td>
                <td class="img-cell">
                    @if($a->tanggapan && $a->tanggapan->foto_tanggapan)
                        <img src="{{ public_path('uploads/tanggapan/'.$a->tanggapan->foto_tanggapan) }}">
                    @else
                        -
                    @endif
                </td>
                <td style="text-align: center;">
                    <span class="{{ strtolower($status) == 'selesai' ? 'status-selesai' : 'status-proses' }}">
                        {{ $status }}
                    </span>
                </td>
                <td>{{ $a->tanggapan->feedback ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-wrapper">
        <p>Pasartanah tinggi, {{ date('d F Y') }}</p>
        <p>Kepala Sekolah</p>
        <div class="signature-space"></div>
        <p>__________________________</p>
    </div>

</body>
</html>