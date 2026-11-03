const formulario = document.getElementById("formJuego");

if (formulario) {
    const input = document.getElementById("numero");
    const error = document.getElementById("error-numero");

    formulario.addEventListener("submit", function (evento) {
        const valor = input.value.trim();
        const numero = Number(valor);

        error.textContent = "";
        input.classList.remove("invalido");

        if (valor === "" || !Number.isInteger(numero) || numero < 1 || numero > 100) {
            evento.preventDefault();
            error.textContent = "Escribe un número entero entre 1 y 100.";
            input.classList.add("invalido");
            input.focus();
        }
    });
}