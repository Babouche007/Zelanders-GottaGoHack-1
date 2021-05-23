function afficher(element) {
    const lignes = document.querySelectorAll(".categorie li");
    lignes.forEach(x => x.setAttribute("active", "false"));
    element.setAttribute("active", "true");
    const text = element.textContent;
    document.querySelector("#change").setAttribute("src", "pages\\liste.php?query=" + text);
}
