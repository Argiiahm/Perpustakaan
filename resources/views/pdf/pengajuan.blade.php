<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan PDF</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 10px;
        }

        .title {
            font-size: 20px;
            color: #6b7280;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 11px;
            color: #9ca3af;
            margin-bottom: 15px;
        }

        .info-row {
            margin-bottom: 5px;
        }

        .label {
            font-weight: bold;
            color: #6b7280;
            width: 100px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #f9fafb;
            color: #9ca3af;
            font-weight: normal;
            text-align: center;
            padding: 12px 8px;
            border-bottom: 1px solid #e5e7eb;
            text-transform: uppercase;
            font-size: 10px;
        }

        td {
            padding: 12px 8px;
            border-bottom: 1px solid #e5e7eb;
            text-align: center;
            color: #35094D;
            vertical-align: middle;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
            text-transform: capitalize;
        }

        .status-dipinjamkan {
            background-color: #d1fae5;
            color: #008767;
        }

        .status-ditolak {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .no-data {
            color: #9ca3af;
            padding: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title">Laporan Konfirmasi Pengajuan</div>
            <div class="subtitle">Laporan konfirmasi pengajuan yang di konfirmasi
                {{ Auth::user()->Petugas->nama_lengkap ?? Auth::user()->username }}.</div>

            <div class="info-row">
                <span class="label">Nama:</span>
                <span>{{ Auth::user()->Petugas->nama_lengkap ?? Auth::user()->username }}</span>
            </div>
            <div class="info-row">
                <span class="label">IDP:</span>
                <span>Petugas#{{ Auth::user()->Petugas->id ?? 'N/A' }}</span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Nik/Nis</th>
                    <th>Nama Peminjam</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuans_konfirmasi as $pengajuan)
                    <tr>
                        <td>{{ $pengajuan->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                        <td>{{ $pengajuan->peminjaman->buku->judul_buku ?? 'N/A' }}</td>
                        <td>{{ $pengajuan->peminjaman->anggota->nomer_induk ?? 'N/A' }}</td>
                        <td>{{ $pengajuan->peminjaman->anggota->nama_lengkap ?? 'N/A' }}</td>
                        <td>{{ $pengajuan->peminjaman->tanggal_pinjam ?? 'N/A' }}</td>
                        <td>{{ $pengajuan->peminjaman->tanggal_jatuh_tempo ?? 'N/A' }}</td>
                        <td>
                            @if ($pengajuan->status === 'dipinjamkan')
                                <span class="badge status-dipinjamkan">
                                    {{ $pengajuan->status }}
                                </span>
                            @elseif ($pengajuan->status === 'ditolak')
                                <span class="badge status-ditolak">
                                    {{ $pengajuan->status }}
                                </span>
                            @else
                                {{ $pengajuan->status }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="no-data">Tidak ada data yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
