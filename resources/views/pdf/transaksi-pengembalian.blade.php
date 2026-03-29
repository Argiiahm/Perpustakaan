<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian PDF</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
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
            padding: 8px 5px;
            border-bottom: 1px solid #e5e7eb;
            text-transform: uppercase;
            font-size: 9px;
        }

        td {
            padding: 8px 5px;
            border-bottom: 1px solid #e5e7eb;
            text-align: center;
            color: #35094D;
            vertical-align: middle;
            font-size: 10px;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
            text-transform: capitalize;
        }

        .status-dikembalikan {
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
            <div class="title">Laporan Konfirmasi Pengembalian</div>
            <div class="subtitle">Perpustakaan Saya - {{ date('Y-m-d') }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Nik/Nis</th>
                    <th>Nama Peminjam</th>
                    <th>Dikembalikan</th>
                    <th>Hari Telat</th>
                    <th>Denda Terbayar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($aktivitas_data as $item)
                    <tr>
                        <td>{{ $item->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                        <td>{{ $item->peminjaman->buku->judul_buku ?? 'N/A' }}</td>
                        <td>{{ $item->peminjaman->anggota->nomer_induk ?? 'N/A' }}</td>
                        <td>{{ $item->peminjaman->anggota->nama_lengkap ?? 'N/A' }}</td>
                        <td>{{ $item->tanggal_kembalikan ?? $item->updated_at->format('Y-m-d') }}</td>
                        <td>{{ ceil($item->total_hari_terlambat ?? 0) }} Hari</td>
                        <td>Rp {{ number_format($item->jumlah_denda, 0, ',', '.') }}</td>
                        <td>
                            @if ($item->status === 'dikembalikan')
                                <span class="badge status-dikembalikan">
                                    {{ $item->status }}
                                </span>
                            @else
                                <span class="badge status-ditolak">
                                    {{ $item->status }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="no-data">Tidak ada data yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
