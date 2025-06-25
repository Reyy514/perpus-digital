<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #7F5AF0; }
        .header p { margin: 5px 0; font-size: 12px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; text-align: left; padding: 8px; }
        th { background-color: #F4F4F5; font-weight: bold; text-transform: uppercase; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 9px; color: #777; }
        .status-badge { display: inline-block; padding: 3px 8px; border-radius: 9999px; font-size: 9px; font-weight: 500; }
        .status-returned { background-color: #d1fae5; color: #065f46; }
        .status-overdue { background-color: #fee2e2; color: #991b1b; }
        .status-active { background-color: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Perpustakaan Digital</h1>
        <p>Laporan Lengkap Peminjaman Buku</p>
        <p>Tanggal Cetak: {{ now()->isoFormat('dddd, DD MMMM YYYY') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Buku</th>
                <th>Peminjam</th>
                <th>Tgl Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->borrowed_at ? $item->borrowed_at->format('d/m/Y') : '-' }}</td>
                {{-- FIX: Mengganti 'due_date' menjadi 'due_at' --}}
                <td>{{ $item->due_at ? $item->due_at->format('d/m/Y') : '-' }}</td>
                <td>{{ $item->returned_at ? $item->returned_at->format('d/m/Y') : '-' }}</td>
                <td>
                    @if($item->returned_at)
                        <span class="status-badge status-returned">Selesai</span>
                    {{-- FIX: Mengganti 'due_date' menjadi 'due_at' --}}
                    @elseif($item->due_at && now()->gt($item->due_at))
                        <span class="status-badge status-overdue">Terlambat</span>
                    @else
                        <span class="status-badge status-active">Dipinjam</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">Tidak ada data peminjaman untuk dilaporkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Laporan ini dibuat secara otomatis oleh sistem Perpustakaan Digital.
    </div>
</body>
</html>
