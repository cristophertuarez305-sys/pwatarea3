const items = document.querySelectorAll(".item");

items.forEach(function (item) {
    const boton = item.querySelector(".item-boton");

    boton.addEventListener("click", function (evento) {
        evento.stopPropagation();
        const yaEstabaAbierto = item.classList.contains("abierto");

        items.forEach(function (otro) {
            otro.classList.remove("abierto");
        });

        if (!yaEstabaAbierto) {
            item.classList.add("abierto");
        }
    });
});

document.addEventListener("click", function () {
    items.forEach(function (item) {
        item.classList.remove("abierto");
    });
});