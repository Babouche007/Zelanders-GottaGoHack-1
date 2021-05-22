function afficher(element) {
    const text = element.textContent;
    document.querySelector("#change").setAttribute("src", "pages\\liste.php?query=" + text);
}