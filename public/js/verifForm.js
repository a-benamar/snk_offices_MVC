function valideInput(unInput) {
    unInput.classList.remove("is-valid", "is-invalid");
    if (unInput.checkValidity()) {
        unInput.classList.add("is-valid");

        return true;
    } else {
        unInput.classList.add("is-invalid");
        return false;
    }
}

let elementForm = document.querySelector("form");
elementForm.addEventListener("submit", function (event) {

    let formValide = true;
    //Recuperer tout les champs du formulaire
    let lesChamps = document.querySelectorAll("form input,form select, form textarea")
    console.log(lesChamps);
    //Parcourir chaque champs
    for (let unChamps of lesChamps) {
        let champValide = valideInput(unChamps);
        if (champValide === false) {
            formValide = false;
        }
    }
    //invoquer la fonction valideInput avec chaque champs en argument
    //si valideInput retourne false forValide devient faux
    if (formValide === false) {
        event.preventDefault();
    }
})

let lesChamps = document.querySelectorAll("form input,form select, form textarea");

for (let unChamps of lesChamps) {
    unChamps.addEventListener("input", function () {
        valideInput(unChamps);
    })
}