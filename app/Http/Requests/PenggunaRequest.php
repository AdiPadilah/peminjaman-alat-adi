<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('user.kelola');
    }

    public function rules(): array
    {
        $penggunaId = $this->route('pengguna')?->id;
        $isUpdate   = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'nama'     => ['required', 'string', 'max:100'],
            'username' => [
                'required', 'string', 'max:50',
                Rule::unique('users', 'username')->ignore($penggunaId),
            ],
            'email' => [
                'required', 'email', 'max:100',
                Rule::unique('users', 'email')->ignore($penggunaId),
            ],
            'no_telp'  => ['required', 'string', 'regex:/^[0-9]+$/', 'min:9', 'max:18'],
            'password' => [
                $isUpdate ? 'nullable' : 'required',
                'string', 'min:8', 'confirmed',
            ],
            'peran'    => ['required', Rule::in(['admin', 'petugas', 'peminjam'])],
            'is_aktif' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'no_telp.min'   => 'Nomor telepon minimal harus 9 digit.',
            'no_telp.max'   => 'Nomor telepon tidak boleh lebih dari 18 digit.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama'     => 'nama lengkap',
            'username' => 'nama pengguna',
            'email'    => 'email',
            'no_telp'  => 'nomor telepon',
            'password' => 'kata sandi',
            'peran'    => 'peran',
            'is_aktif' => 'status aktif',
        ];
    }
}
