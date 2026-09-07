<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LayananFotoKondisi
{
    private string $targetFolder;

    public function __construct()
    {
        $this->targetFolder = public_path('gambar/kondisi');

        if (!File::isDirectory($this->targetFolder)) {
            File::makeDirectory($this->targetFolder, 0755, true, true);
        }
    }

    /**
     * Simpan foto kondisi dari upload file atau base64 snapshot webcam.
     */
    public function simpan(
        string $prefix,
        int $detailId,
        mixed $file = null,
        ?string $base64 = null,
        ?string $fotoLama = null
    ): ?string {
        $namaFile = null;

        if ($file instanceof UploadedFile && $file->isValid()) {
            $ekstensi = $file->getClientOriginalExtension() ?: 'jpg';
            $namaFile = sprintf('%s_%d_%s.%s', $prefix, $detailId, Str::random(10), strtolower($ekstensi));
            $file->move($this->targetFolder, $namaFile);
        } elseif (!empty($base64) && str_starts_with($base64, 'data:image/')) {
            $namaFile = $this->simpanBase64($prefix, $detailId, $base64);
        }

        if ($namaFile && $fotoLama) {
            $this->hapus($fotoLama);
        }

        return $namaFile;
    }

    /**
     * Decode base64 gambar dan simpan sebagai file jpg.
     */
    private function simpanBase64(string $prefix, int $detailId, string $base64): ?string
    {
        try {
            // Pisahkan header dan data base64 (contoh: data:image/jpeg;base64,/9j/4AAQSkZJRg...)
            @list($type, $data) = explode(';', $base64);
            @list(, $data)      = explode(',', $data);

            if (empty($data)) {
                return null;
            }

            $binaryData = base64_decode($data);
            if ($binaryData === false) {
                return null;
            }

            $namaFile = sprintf('%s_%d_%s.jpg', $prefix, $detailId, Str::random(10));
            $pathLengkap = $this->targetFolder . DIRECTORY_SEPARATOR . $namaFile;

            File::put($pathLengkap, $binaryData);

            return $namaFile;
        } catch (\Throwable $e) {
            report($e);
            return null;
        }
    }

    /**
     * Hapus file foto dari folder kondisi.
     */
    public function hapus(?string $namaFile): bool
    {
        if (empty($namaFile)) {
            return false;
        }

        $path = $this->targetFolder . DIRECTORY_SEPARATOR . $namaFile;

        if (File::exists($path)) {
            return File::delete($path);
        }

        return false;
    }
}
