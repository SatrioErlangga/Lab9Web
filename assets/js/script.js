document.addEventListener('DOMContentLoaded', function () {
    // 1. Konfirmasi hapus data barang
    const deleteForms = document.querySelectorAll('.form-hapus');
    deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data barang ini?')) {
                e.preventDefault();
            }
        });
    });

    // 2. Auto-hide flash message setelah 4 detik
    const alertBox = document.querySelector('.alert');
    if (alertBox) {
        setTimeout(function () {
            alertBox.style.transition = 'opacity 0.5s ease';
            alertBox.style.opacity = '0';
            setTimeout(function () {
                alertBox.remove();
            }, 500);
        }, 4000);
    }

    // 3. Preview gambar pada form tambah/ubah barang
    const fileInput = document.querySelector('input[name="file_gambar"]');
    if (fileInput) {
        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            let preview = document.getElementById('img-preview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'img-preview';
                preview.style.maxWidth = '150px';
                preview.style.marginTop = '8px';
                preview.style.borderRadius = '4px';
                fileInput.insertAdjacentElement('afterend', preview);
            }
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        });
    }
});