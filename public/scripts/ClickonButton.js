


document.addEventListener("click", function (event) {
    if (event.target.closest(".vakje")) return;


    // alle vakjes eerst sluiten
    document.querySelectorAll(".vakje").forEach(vakje => {
        vakje.style.display = "none";
        vakje.style.pointerEvents = "none";

    })

    const knopgeklikt = event.target.closest(".muisover-knop");

    // Als er op een knop is geklikt, open het vakje
    if (knopgeklikt) {
        const vakje = knopgeklikt.parentElement.querySelector(".vakje");

        if (vakje) {
            vakje.style.display = "block";
            vakje.style.pointerEvents = "all";
        }
    }
}
)