// execulte a instrução quando o usuario seleciona uma imagem
var redimenciona = $('#preview').croppie({
    // Ativa a leitura de orientação para renderizar corretamente a imagem
    enableExif: true,

    // Ativa orientação personalizada
    enableOrientation: true,


    // O recipiente interno do coppie. A parte visivel da imagem
    viewport:{
        width: 100,
        height: 100,
        type: 'circle'
    },

    boundary: { 
         width: 140,
         height: 140
        }

});

$('#image-perfil').on('change', function(){
    // FileReader para ler de forma assicrona o conteudo dos arquivos

   var reader = new FileReader()

   // onload - execute apos ler o conteudo

   reader.onload = function(e){
        redimenciona.croppie('bind',{
            url: e.target.result
        })
   }

   // o metodo readAsDataURL é usado para ler do tipo blob ou file
   reader.readAsDataURL(this.files[0]);

})

// executar a intrunção quando o usuario clicar no botão enviar
$('.btn-upload-imagem').on('click', function(){
    redimenciona.croppie('result', {
        type: 'canvas', // Tipo de arquivos permitidos - base64, html, blob
        size: 'viewport', // o tamanho da imagem cortada
    }).then(function (img){
        $.ajax({
            url: "app/views/cadastro/cadastro.php", // envia os dados para o arquivo upload.php
            type: "POST",  // metodo utilizado para envia os dados
            data: { // Dados que deve se enviados
                "imagem": img
            },

            success: function(){
                alert("imagem com sucesso")
            }
        })
    })
})