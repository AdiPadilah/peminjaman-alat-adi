<!-- Modal Pratinjau Gambar / Lightbox -->
<div class="modal fade" id="modalLihatFoto" tabindex="-1" aria-labelledby="labelModalLihatFoto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white py-2">
                <h6 class="modal-title" id="labelModalLihatFoto">
                    <i class="bi bi-image me-1"></i> <span id="judulFotoModal">Bukti Foto Kondisi</span>
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center p-2 bg-dark">
                <img id="gambarPenuhModal" src="" alt="Bukti Foto" class="img-fluid rounded shadow-sm" style="max-height: 80vh; object-fit: contain;">
            </div>
            <div class="modal-footer py-1 bg-white justify-content-between">
                <small class="text-muted" id="subjudulFotoModal"></small>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalLihatFotoEl = document.getElementById('modalLihatFoto');
    if (!modalLihatFotoEl) return;

    const modalLihatFoto = new bootstrap.Modal(modalLihatFotoEl);
    const gambarModal = document.getElementById('gambarPenuhModal');
    const judulModal = document.getElementById('judulFotoModal');
    const subjudulModal = document.getElementById('subjudulFotoModal');

    // Event delegasi klik untuk elemen berkelas .img-pratinjau
    document.addEventListener('click', function(e) {
        const target = e.target.closest('.img-pratinjau');
        if (target) {
            const url = target.getAttribute('src');
            const judul = target.getAttribute('data-judul') || target.getAttribute('title') || 'Bukti Foto Kondisi';
            const info = target.getAttribute('data-info') || '';

            gambarModal.src = url;
            judulModal.textContent = judul;
            subjudulModal.textContent = info;

            modalLihatFoto.show();
        }
    });
});
</script>
