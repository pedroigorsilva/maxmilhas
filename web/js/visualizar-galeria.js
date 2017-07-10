$(document).ready(function(){
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
                "<li>\
                    <img src=\"web/upload/"+item.caminho+"\">\
                </li>";
        });
    } else {
        html = "<li>Não existem imagens cadastradas</li>"
    }


    $('#imagens').html(html);

    carregaFuncoesGaleria();
}

function carregaFuncoesGaleria()
{
    $('#checkbox').change(function(){
        setInterval(function () {
            moveRight();
        }, 3000);
    });

    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({ width: slideWidth, height: slideHeight });

    $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });
}