document.addEventListener('DOMContentLoaded', function () {
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    if (imageModal) {
        imageModal.addEventListener('show.bs.modal', function (event) {
            const img = event.relatedTarget;
            modalImage.src = img.getAttribute('data-bs-img');
        });
    }
});