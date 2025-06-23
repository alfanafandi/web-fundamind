document.addEventListener('DOMContentLoaded', function () {
  const questBox = document.querySelector('.quest-box');

  if (questBox) {
    questBox.addEventListener('click', function (e) {
      e.preventDefault();

      fetch('quest-details.html')
        .then(response => response.text())
        .then(html => {
          document.getElementById('questModalContainer').innerHTML = html;
          const modalEl = document.getElementById('questModal');
          const modal = new bootstrap.Modal(modalEl);
          modal.show();
        })
        .catch(err => {
          console.error('Gagal memuat quest-detail.html:', err);
        });
    });
  }
});
