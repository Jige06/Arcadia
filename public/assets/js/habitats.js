// Au clic sur une carte d'habitat : récupère le détail en JSON et l'affiche dans une modale
document.querySelectorAll('.habitat-card').forEach(function (carte) {
    carte.addEventListener('click', function () {
        const habitatId = carte.dataset.habitatId;

        fetch(`/habitat-detail?id=${habitatId}`)
            .then(function (reponse) {
                return reponse.json();
            })
            .then(function (donnees) {
                afficherDetailHabitat(donnees);
            })
            .catch(function (erreur) {
                console.error('Erreur lors de la récupération du détail :', erreur);
            });
    });
});

function afficherDetailHabitat(donnees) {
    document.getElementById('habitatModalTitre').textContent = donnees.nom;
    document.getElementById('habitatModalDescription').textContent = donnees.description;

    const listeAnimaux = document.getElementById('habitatModalAnimaux');
    listeAnimaux.innerHTML = '';

    donnees.animaux.forEach(function (animal) {
        const item = document.createElement('li');
        item.className = 'list-group-item';
        item.style.cursor = 'pointer';
        item.textContent = animal.prenom + ' (' + animal.race + ') - État : ' + animal.etat;

        // Au clic sur un animal précis : incrémente sa statistique de consultation (US11)
        item.addEventListener('click', function () {
            enregistrerConsultation(animal.id, animal.prenom);
        });

        listeAnimaux.appendChild(item);
    });

    const modal = new bootstrap.Modal(document.getElementById('habitatModal'));
    modal.show();
}

function enregistrerConsultation(animalId, prenomAnimal) {
    fetch('/consultation', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            animal_id: animalId,
            prenom: prenomAnimal
        })
    }).catch(function (erreur) {
        console.error('Erreur lors de l\'enregistrement de la consultation :', erreur);
    });
}