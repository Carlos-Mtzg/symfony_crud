window.confirmarSweet = function (pregunta, ruta) {
    Swal.fire({
        title: pregunta,
        icon: 'warning',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = ruta;
        }
    })
}