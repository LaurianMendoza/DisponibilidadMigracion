function Search() {
    let input = document.getElementById('search__input').value
    input=input.toLowerCase();
    let content = document.getElementsByClassName('search_content_items');
    let items = document.getElementsByClassName('search_content_items');

    var cadena = removeAccents(input);

    console.log("buscando->".cadena); //

    for (i = 0; i < items.length; i++) {
        let textoItems = removeAccents(items[i].innerHTML.toLowerCase());
        if (!textoItems.includes(cadena)) {
            items[i].style.display="none";
        }
        else {
            items[i].style.display="flex";
        }
    }
}


//funcion para eliminar los acentos
const removeAccents = (str) => {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}
