<?php

namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BorrowingsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Borrowing::with(['user', 'book'])->get();
    }

    public function headings(): array
    {
        return [
            'ID Pinjam',
            'Judul Buku',
            'Penulis',
            'Nama Peminjam',
            'Email Peminjam',
            'Tanggal Pinjam',
            'Batas Kembali',
            'Tanggal Dikembalikan',
            'Status',
        ];
    }

    public function map($borrowing): array
    {
        $status = 'Selesai';
        if (!$borrowing->returned_at) {
            $status = now()->gt($borrowing->due_at) ? 'Terlambat' : 'Dipinjam';
        }

        return [
            $borrowing->id,
            $borrowing->book->title,
            $borrowing->book->author,
            $borrowing->user->name,
            $borrowing->user->email,
            $borrowing->borrowed_at->format('Y-m-d H:i:s'),
            $borrowing->due_at->format('Y-m-d H:i:s'),
            $borrowing->returned_at ? $borrowing->returned_at->format('Y-m-d H:i:s') : 'N/A',
            $status,
        ];
    }
}