<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::with('kategori')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama User',
            'Email',
            'Kategori (Role)',
            'Terdaftar Pada',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->kategori->nama_kategori, // Mengambil nama kategori dari relasi
            $user->created_at->format('d-m-Y'),
        ];
    }
}