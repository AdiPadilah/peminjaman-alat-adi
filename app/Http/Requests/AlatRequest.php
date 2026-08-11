<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('alat.kelola');
    }

    public function rules(): array
    {
        $alatId = $this->route('alat')?->id;
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'kategori_id' => ['required', 'exists:kategori,id'],
            'kode_alat'   => [
                'required', 'string', 'max:30',
                Rule::unique('alat', 'kode_alat')->ignore($alatId),
            ],
            'nama'         => ['required', 'string', 'max:150'],
            'deskripsi'    => ['nullable', 'string', 'max:1000'],
            'stok'         => ['required', 'integer', 'min:0'],
            'stok_tersedia' => ['required', 'integer', 'min:0', 'lte:stok'],
            'kondisi'      => ['required', Rule::in(['baik', 'rusak_ringan', 'rusak_berat'])],
            'foto'         => [
                $isUpdate ? 'nullable' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'kategori_id'  => 'kategori',
            'kode_alat'    => 'kode alat',
            'nama'         => 'nama alat',
            'stok'         => 'stok',
            'stok_tersedia' => 'stok tersedia',
            'kondisi'      => 'kondisi',
            'foto'         => 'foto',
        ];
    }
}
