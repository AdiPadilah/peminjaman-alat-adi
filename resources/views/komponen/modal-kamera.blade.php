<!-- Modal Kamera Webcam -->
<div class="modal fade" id="modalKameraWebcam" tabindex="-1" aria-labelledby="labelModalKamera" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fs-6" id="labelModalKamera">
                    <i class="bi bi-camera-video me-1"></i> Ambil Foto Kondisi Alat: <span id="namaAlatKamera" class="fw-bold text-warning">-</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup" id="btnTutupModalKamera"></button>
            </div>
            <div class="modal-body text-center p-3 bg-light">
                <!-- Pilihan Kamera (jika ada lebih dari 1 kamera/webcam) -->
                <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                    <small class="text-muted"><i class="bi bi-webcam me-1"></i>Pilih Perangkat:</small>
                    <select id="pilihSumberKamera" class="form-select form-select-sm w-auto">
                        <option value="">Deteksi kamera...</option>
                    </select>
                </div>

                <!-- Area Live Video Webcam -->
                <div id="wadahVideo" class="position-relative bg-black rounded overflow-hidden d-flex justify-content-center align-items-center" style="min-height: 320px; max-height: 480px;">
                    <video id="videoWebcam" autoplay playsinline muted class="w-100 h-100" style="object-fit: cover;"></video>
                    
                    <!-- Indikator Loading / Error -->
                    <div id="pesanKamera" class="position-absolute text-white p-3 d-none">
                        <div class="spinner-border spinner-border-sm mb-2" role="status"></div>
                        <div>Menghubungkan ke kamera...</div>
                    </div>
                </div>

                <!-- Canvas untuk Hasil Jepretan (disembunyikan saat mode video aktif) -->
                <div id="wadahHasilJepret" class="bg-black rounded overflow-hidden d-none justify-content-center align-items-center" style="min-height: 320px; max-height: 480px;">
                    <canvas id="canvasJepret" class="w-100 h-100 rounded" style="object-fit: contain;"></canvas>
                </div>
            </div>
            <div class="modal-footer bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                
                <div>
                    <!-- Tombol Ambil Ulang & Gunakan (muncul setelah jepret) -->
                    <button type="button" id="btnAmbilUlang" class="btn btn-warning btn-sm d-none me-2">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Ambil Ulang
                    </button>
                    <button type="button" id="btnGunakanFoto" class="btn btn-success btn-sm d-none">
                        <i class="bi bi-check-lg me-1"></i> Gunakan Foto Ini
                    </button>

                    <!-- Tombol Jepret (aktif saat video berjalan) -->
                    <button type="button" id="btnJepret" class="btn btn-primary btn-sm">
                        <i class="bi bi-camera me-1"></i> Jepret Foto
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalEl = document.getElementById('modalKameraWebcam');
    if (!modalEl) return;

    const modalKamera = new bootstrap.Modal(modalEl);
    const video = document.getElementById('videoWebcam');
    const canvas = document.getElementById('canvasJepret');
    const wadahVideo = document.getElementById('wadahVideo');
    const wadahHasilJepret = document.getElementById('wadahHasilJepret');
    const btnJepret = document.getElementById('btnJepret');
    const btnAmbilUlang = document.getElementById('btnAmbilUlang');
    const btnGunakanFoto = document.getElementById('btnGunakanFoto');
    const selectKamera = document.getElementById('pilihSumberKamera');
    const labelNamaAlat = document.getElementById('namaAlatKamera');
    const pesanKamera = document.getElementById('pesanKamera');

    let streamAktif = null;
    let detailIdAktif = null;
    let targetPrefixAktif = 'sesudah';
    let dataUrlHasil = null;

    // Fungsi Menghentikan Stream Kamera agar lampu webcam mati
    function matikanKamera() {
        if (streamAktif) {
            streamAktif.getTracks().forEach(track => track.stop());
            streamAktif = null;
        }
        if (video) {
            video.srcObject = null;
        }
    }

    // Fungsi Mengaktifkan Stream Kamera
    async function nyalakanKamera(deviceId = null) {
        matikanKamera();
        pesanKamera.classList.remove('d-none');
        pesanKamera.innerHTML = '<div class="spinner-border spinner-border-sm mb-2" role="status"></div><div>Menghubungkan ke kamera...</div>';

        const constraints = {
            video: {
                width: { ideal: 1280 },
                height: { ideal: 720 },
                facingMode: deviceId ? undefined : { ideal: 'environment' }
            },
            audio: false
        };

        if (deviceId) {
            constraints.video.deviceId = { exact: deviceId };
        }

        try {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                throw new Error('Browser tidak mendukung akses kamera.');
            }

            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            streamAktif = stream;
            video.srcObject = stream;
            pesanKamera.classList.add('d-none');

            // Daftarkan list device kamera jika belum
            muatDaftarKamera();
        } catch (err) {
            pesanKamera.classList.remove('d-none');
            pesanKamera.innerHTML = '<div class="text-danger"><i class="bi bi-exclamation-triangle fs-4 d-block mb-1"></i>Gagal mengakses webcam.<br><small class="text-white-50">Pastikan izin kamera diizinkan di browser Anda.</small></div>';
            console.error('Webcam error:', err);
        }
    }

    async function muatDaftarKamera() {
        if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) return;
        try {
            const devices = await navigator.mediaDevices.enumerateDevices();
            const videoDevices = devices.filter(d => d.kind === 'videoinput');
            
            selectKamera.innerHTML = '';
            if (videoDevices.length === 0) {
                selectKamera.innerHTML = '<option value="">Kamera Utama</option>';
                return;
            }

            videoDevices.forEach((device, idx) => {
                const opt = document.createElement('option');
                opt.value = device.deviceId;
                opt.text = device.label || `Kamera ${idx + 1}`;
                selectKamera.appendChild(opt);
            });
        } catch (e) {
            console.log('Error enumerate devices:', e);
        }
    }

    selectKamera.addEventListener('change', function() {
        if (this.value) {
            nyalakanKamera(this.value);
        }
    });

    // Buka Modal saat Tombol Kamera di baris alat diklik
    document.querySelectorAll('.btn-buka-kamera').forEach(btn => {
        btn.addEventListener('click', function() {
            detailIdAktif = this.getAttribute('data-detail-id');
            targetPrefixAktif = this.getAttribute('data-prefix') || 'sesudah';
            const namaAlat = this.getAttribute('data-nama-alat') || 'Alat';

            labelNamaAlat.textContent = namaAlat;

            // Reset UI modal
            wadahVideo.classList.remove('d-none');
            wadahHasilJepret.classList.add('d-none');
            btnJepret.classList.remove('d-none');
            btnAmbilUlang.classList.add('d-none');
            btnGunakanFoto.classList.add('d-none');
            dataUrlHasil = null;

            modalKamera.show();
            nyalakanKamera();
        });
    });

    // Jepret Foto
    btnJepret.addEventListener('click', function() {
        if (!video.videoWidth) return;

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Kompres sedikit ke jpeg quality 0.85
        dataUrlHasil = canvas.toDataURL('image/jpeg', 0.85);

        wadahVideo.classList.add('d-none');
        wadahHasilJepret.classList.remove('d-none');
        wadahHasilJepret.classList.add('d-flex');

        btnJepret.classList.add('d-none');
        btnAmbilUlang.classList.remove('d-none');
        btnGunakanFoto.classList.remove('d-none');
    });

    // Ambil Ulang
    btnAmbilUlang.addEventListener('click', function() {
        dataUrlHasil = null;
        wadahVideo.classList.remove('d-none');
        wadahHasilJepret.classList.add('d-none');
        wadahHasilJepret.classList.remove('d-flex');

        btnJepret.classList.remove('d-none');
        btnAmbilUlang.classList.add('d-none');
        btnGunakanFoto.classList.add('d-none');
    });

    // Gunakan Foto Ini
    btnGunakanFoto.addEventListener('click', function() {
        if (!dataUrlHasil || !detailIdAktif) return;

        // Cari input hidden kamera di baris terkait
        const inputHidden = document.querySelector(`input[name="foto_kamera[${detailIdAktif}]"]`);
        const inputFile = document.querySelector(`input[name="foto_file[${detailIdAktif}]"]`);
        const wadahPratinjau = document.getElementById(`pratinjau_foto_${detailIdAktif}`);

        if (inputHidden) {
            inputHidden.value = dataUrlHasil;
        }

        // Kosongkan file input agar prioritas foto kamera yang tersimpan
        if (inputFile) {
            inputFile.value = '';
        }

        if (wadahPratinjau) {
            wadahPratinjau.innerHTML = `
                <div class="d-inline-flex align-items-center gap-1 p-1 border rounded bg-white shadow-sm position-relative">
                    <img src="${dataUrlHasil}" alt="Foto Kamera" class="rounded cursor-pointer img-pratinjau" style="width: 44px; height: 44px; object-fit: cover;" title="Klik untuk memperbesar">
                    <div class="d-flex flex-column text-start me-1">
                        <span class="badge bg-success" style="font-size: 0.68rem;"><i class="bi bi-camera me-1"></i>Kamera</span>
                        <button type="button" class="btn btn-link text-danger p-0 text-decoration-none btn-hapus-foto" data-detail-id="${detailIdAktif}" style="font-size: 0.72rem;">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
            pasangEventHapusFoto(detailIdAktif);
        }

        matikanKamera();
        modalKamera.hide();
    });

    // Matikan stream saat modal ditutup
    modalEl.addEventListener('hidden.bs.modal', function() {
        matikanKamera();
    });

    // Event Delegasi untuk Hapus Foto
    function pasangEventHapusFoto(id) {
        const btnHapus = document.querySelector(`.btn-hapus-foto[data-detail-id="${id}"]`);
        if (btnHapus) {
            btnHapus.addEventListener('click', function() {
                const hiddenInput = document.querySelector(`input[name="foto_kamera[${id}]"]`);
                const fileInput = document.querySelector(`input[name="foto_file[${id}]"]`);
                const wadah = document.getElementById(`pratinjau_foto_${id}`);

                if (hiddenInput) hiddenInput.value = '';
                if (fileInput) fileInput.value = '';
                if (wadah) wadah.innerHTML = '';
            });
        }
    }

    // Tangani perubahan file input upload biasa
    document.querySelectorAll('.input-foto-file').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.getAttribute('data-detail-id');
            const file = this.files[0];
            if (!file) return;

            // Kosongkan input kamera jika pilih file
            const hiddenKamera = document.querySelector(`input[name="foto_kamera[${id}]"]`);
            if (hiddenKamera) hiddenKamera.value = '';

            const reader = new FileReader();
            reader.onload = function(e) {
                const wadahPratinjau = document.getElementById(`pratinjau_foto_${id}`);
                if (wadahPratinjau) {
                    wadahPratinjau.innerHTML = `
                        <div class="d-inline-flex align-items-center gap-1 p-1 border rounded bg-white shadow-sm position-relative">
                            <img src="${e.target.result}" alt="Foto File" class="rounded cursor-pointer img-pratinjau" style="width: 44px; height: 44px; object-fit: cover;" title="Klik untuk memperbesar">
                            <div class="d-flex flex-column text-start me-1">
                                <span class="badge bg-primary" style="font-size: 0.68rem;"><i class="bi bi-file-earmark-image me-1"></i>Berkas</span>
                                <button type="button" class="btn btn-link text-danger p-0 text-decoration-none btn-hapus-foto" data-detail-id="${id}" style="font-size: 0.72rem;">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    `;
                    pasangEventHapusFoto(id);
                }
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
