$().ready(function(){
    $(document).on("click", "#cadastrar-imagem", function(){
        var formData = new FormData();
        formData.append('imagem', $('#imagem')[0].files[0]);
        enviarImagem(formData);
    });
});

function enviarImagem(formData) {
    $.ajax({
        url:'imagem',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success:function(response, status, request){
            var retorno = JSON.parse(response);
            alert(retorno.mensagem);
            location.reload();
        },
        error:function(status,request,error){
            alert('Ocorreu um erro ao enviar a imagem para upload');
        }
    });
}