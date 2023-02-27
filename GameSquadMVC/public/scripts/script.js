
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

// Modal de confirmation d'envoi de mail suite a la validation du formulaire de contact

document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('mailSend');
  setTimeout(function() {
    modal.classList.add('hidden');
  }, 3000);
  showModal(modal);
});

// confirmation de suppresion de compte
const btnSupProfil = document.getElementById("btnSup");

btnSupProfil.addEventListener("click", function() {

  const confirmation = confirm("Êtes-vous sûr de vouloir supprimer votre profil ?");
  if (confirmation) {

    // Si l'utilisateur a cliqué sur "OK", supprimez le profil ici
    window.location.href = "index.php?page=user&action=delete";
  }

});



// pour que la date max soit la date du jour
const dateInput = document.getElementById("birthday");
const today = new Date().toISOString().split('T')[0];
dateInput.setAttribute('max', today);


