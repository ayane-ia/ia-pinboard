let salvaPerfil = document.querySelector('#salva');
let alert_personalizado = document.querySelector('#alert-personalizado');
let cancelarEditar = document.querySelector('#cancelar-editar');
let bodyPagina = document.querySelector('body');
salvaPerfil.addEventListener('click', () => {
    alert_personalizado.style.display = 'flex'
    cancelarEditar.addEventListener('click', () => {
        alert_personalizado.style.display = 'none';
        

    })
})

salvaPerfil.addEventListener('click', () => {
    bodyPagina.style.overflow = "hidden";
  cancelarEditar.addEventListener('click', () => {
    bodyPagina.style.overflow = "auto";
  })  
})