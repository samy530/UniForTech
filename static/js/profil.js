document.getElementById('btn-modifier').addEventListener('click', function() {
    // Masquer le premier formulaire
    document.querySelector('#modifier_profil form').style.display = 'none';

    // Afficher le formulaire de modification
    document.getElementById('modification-form').style.display = 'block';

    // Afficher les boutons "Sauvegarder" et "Annuler"
    document.getElementById('btn-sauvegarder').style.display = 'inline-block';
    document.getElementById('btn-annuler').style.display = 'inline-block';
});

document.getElementById('btn-annuler').addEventListener('click', function() {
    // Réinitialiser les champs du formulaire de modification
    document.getElementById('modification-form').reset();

    // Masquer le formulaire de modification
    document.getElementById('modification-form').style.display = 'none';

    // Afficher à nouveau le premier formulaire
    document.querySelector('#modifier_profil form').style.display = 'block';

    // Cacher les boutons "Sauvegarder" et "Annuler"
    document.getElementById('btn-sauvegarder').style.display = 'none';
    document.getElementById('btn-annuler').style.display = 'none';
});

function showLevels() {
    var lmdRadio = document.getElementById("lmd");
    var ingenieurRadio = document.getElementById("ingenieur");
    var levelsDiv = document.getElementById("levels");
    var specialtiesDiv = document.getElementById("specialties");

    if (lmdRadio.checked) {
        levelsDiv.style.display = "block";
        specialtiesDiv.style.display = "block";
        populateLevels(["L1", "L2", "L3", "M1", "M2"]);
        showSpecialties(); // Appel de la fonction pour mettre à jour les spécialités
    } else if (ingenieurRadio.checked) {
        levelsDiv.style.display = "block";
        specialtiesDiv.style.display = "none"; // Hide specialties for ingenieur
        populateLevels(["1ère année", "2ème année", "3ème année", "4ème année", "5ème année"]);
    } else {
        levelsDiv.style.display = "none";
        specialtiesDiv.style.display = "none";
    }
}
        function populateLevels(levels) {
            var niveauSelect = document.getElementById("niveau");
            niveauSelect.innerHTML = ""; // Clear previous options

            levels.forEach(function(level) {
                var option = document.createElement("option");
                option.text = level;
                niveauSelect.add(option);
            });
        }

        function showSpecialties() {
            var niveauSelect = document.getElementById("niveau");
            var specialiteSelect = document.getElementById("specialite");
            var specialties = {
                "L1": ["Informatique"],
                "L2": ["Informatique"],
                "L3": ["Systèmes Informatiques"],
                "M1": ["Conduite de Projets Informatiques","Systèmes Informatiques","Ingénierie des Systèmes d’information","Réseaux, Mobilité et Systèmes Embarqués","Systèmes Informatiques Intelligents"],
                "M2": ["Conduite de Projets Informatiques","Systèmes Informatiques","Ingénierie des Systèmes d’information"," Réseaux, Mobilité et Systèmes Embarqués","Systèmes Informatiques Intelligents"]
            };

            var selectedNiveau = niveauSelect.value;
            specialiteSelect.innerHTML = ""; // Clear previous options

            specialties[selectedNiveau].forEach(function(specialite) {
                var option = document.createElement("option");
                option.text = specialite;
                specialiteSelect.add(option);
            });
        }
document.getElementById('repeat-password').addEventListener('input', function() {
    var newPassword = document.getElementById('new-password').value;
    var repeatPassword = this.value;
    var passwordError = document.getElementById('password-error');

    if (newPassword !== repeatPassword) {
        passwordError.style.display = 'block';
    } else {
        passwordError.style.display = 'none';
    }
});
function displayPhoto(input) {
    // Afficher un aperçu de l'image sélectionnée
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.media img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function deletePhoto() {
    // Demander confirmation à l'utilisateur avant de supprimer l'image
    if (confirm("Are you sure you want to delete your profile picture?")) {
        // Redirection vers un script de suppression d'image côté serveur
        window.location.href = "./traitement/supprimer_photo.php";
    }
}

