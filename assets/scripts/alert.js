let salvaPerfil = document.querySelector('#salva');
let alert_personalizado = document.querySelector('#alert-personalizado');
let cancelarEditar = document.querySelector('#cancelar-editar');

salvaPerfil.addEventListener('click', () => {
    alert_personalizado.style.display = 'flex'
    cancelarEditar.addEventListener('click', () => {
        alert_personalizado.style.display = 'none'
    })
})