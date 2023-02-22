
// traitement js de la modal suite a validation du formulaire
function showModal(modal) {
  const span = modal.querySelector('.close');
  span.onclick = function() {
  modal.classList.add('hidden');
}
  modal.classList.remove('hidden');
}

  document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('myModal');
  setTimeout(function() {
  modal.classList.add('hidden');
}, 2000);
  showModal(modal);
});


// pour que la date max soit la date du jour
const dateInput = document.getElementById("birthday");
const today = new Date().toISOString().split('T')[0];
dateInput.setAttribute('max', today);


