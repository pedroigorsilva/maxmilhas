$().ready(function(){
    buscaGaleriaFotos();
});

function buscaGaleriaFotos() {
    $.ajax({
        url:'buscar',
        method: "GET",
        contentType: 'json',
        success:function(response, status, request){
            var retorno = JSON.parse(response);
            gerarTabela(retorno.galeria);
        },
        error:function(status,request,error){
            alert('Ocorreu um erro ao buscar as imagens da galeria');
        }
    });
}

function gerarTabela(imagens)
{
    var html= '';

    if (imagens.length > 0) {
        imagens.forEach(function (item, index) {
            html +=
                "<tr>\
                    <td>\
                        <img src=\"web/upload/"+item.caminho+"\" width=\"300\">\
                    </td>\
                    <td>\
                        "+item.caminho+"\
                    </td>\
                    <td>\
                        <a href=\"web/upload/"+item.caminho+"\" target=\"_blank\"> Ver imagem </a> |\
                        <a href=\"#\" onclick=\"removerImagem("+item.imagemId+")\"> Remover imagem </a>\
                    </td>\
                </tr>";
        });
    } else {
        html = "<tr><td colspan=\"3\">Não existem imagens cadastradas</td></tr>"
    }


    $('#imagens').html(html);
}

function removerImagem(imagemId)
{
    var formData = new FormData();
    formData.append('imagemId', imagemId);

    $.ajax({
        url:'deletar',
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
            console.log(status,request,error)
            alert('Ocorreu um erro ao deletar a imagem da galeria');
        }
    });
}