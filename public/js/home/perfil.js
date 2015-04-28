/**
 * @author David Abraão
 * @version 1.0
 */

$(document).ready(function() {

    var buscaperfil = 1;
    if (buscaperfil == 1) {
        $.ajax({
            type: 'POST',
            url: '/ws/perfil/userimage/',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(k, v) {
                    $('#new').html('<div id="img_profile" class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 260px; line-height: 10px;">\n\
                                    <img id="img_upload" name="img_upload" style="max-height: 250px;" src="' + v + '">\n\
                                    </div>');
                });

            }, error: function(data) {

                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 450);
            }
        });
    }

    $('#pesq_img').click(function() {
        //$('input').click();
        $('#file_upload_perfil').click();
    });

    $('#img_profile').click(function() {
        //$('input').click();
        $('#file_upload_perfil').click();
    });

    findUf(ufClient);
    getCidade(idEstadoClient, cidadeClient);


    //Init jquery spinner init - default
    $("#chosen-list1").chosen();

    $('#submitFormPerfil').click(function() {
        editPerfil();
    });
    
});

function getCidade(idEstado, cidade) {

    if (idEstado == '') {
        return false;
    } else {
        $('#loading').modal('show');
        $.ajax({
            type: 'POST',
            url: '/ws/cidade/getusercidade/estado/' + idEstado,
            dataType: 'json',
            success: function(data) {
                var option = '';
                $.each(data, function(k, v) {
                    if (v.nomeCidade == cidade) {
                        option += '<option value="' + v.idCidade + '" selected> ' + v.nomeCidade + ' </option>';
                    } else {
                        option += '<option value="' + v.idCidade + '"> ' + v.nomeCidade + ' </option>';
                    }
                });

                $('#result_cidade').html('<label for="chosen-list1" class="col-md-3 control-label">Selecione a Cidade:</label>\
                    <div class="col-md-9">\
                        <select class="form-control" id="cidade" name="cidade" >\
                        <option > Selecione.. </option>\
                            ' + option + '\
                        </select>\
                    </div>');


                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 600);
                $('#result_cidade').fadeIn(200);

            },
            error: function(data) {
                alert('erro');
                $('#loading').modal('hide');
            }
        });
    }
}


function findCidade(idEstado) {

    if (idEstado == '') {
        return false;
    } else {
        $('#loading').modal('show');
        $.ajax({
            type: 'POST',
            url: '/ws/cidade/getusercidade/estado/' + idEstado,
            dataType: 'json',
            success: function(data) {
                var option = '';
                $.each(data, function(k, v) {
                    option += '<option value="' + v.idCidade + '"> ' + v.nomeCidade + ' </option>';

                });

                $('#result_cidade').html('<label for="chosen-list1" class="col-md-3 control-label">Selecione a Cidade:</label>\
                    <div class="col-md-9">\
                        <select class="form-control" id="cidade" name="cidade" onchange="getBairro(this.value);">\
                        <option > Selecione.. </option>\
                            ' + option + '\
                        </select>\
                    </div>');


                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 600);
                ;
                $('#result_cidade').fadeIn(200);

            },
            error: function(data) {
                alert('erro');
                $('#loading').modal('hide');
            }
        });
    }
}


function findUf(uf) {
    if (uf == '') {
        return false;
    } else {
        $('#loading').modal('show');

        $.ajax({
            type: 'POST',
            url: '/ws/estado/getuserestado/',
            dataType: 'json',
            success: function(data) {
                var option = '';
                $.each(data, function(k, v) {
                    if (v.sigaEstado == uf) {

                        option += '<option value="' + v.idEstado + '" selected> ' + v.sigaEstado + ' -' + v.nomeEstado + ' </option>';
                    } else {
                        option += '<option value="' + v.idEstado + '"> ' + v.sigaEstado + ' -' + v.nomeEstado + ' </option>';
                    }
                });

                $('#result_uf').html('<label for="chosen-list1" class="col-md-3 control-label">Selecione a Cidade:</label>\
                    <div class="col-md-9">\
                        <select class="form-control" id="estado" name="estado" onchange="findCidade(this.value);">\
                        <option > Selecione.. </option>\
                            ' + option + '\
                        </select>\
                    </div>');


                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 600);

                $('#result_uf').fadeIn(200);

            },
            error: function(data) {
                $('#loading').modal('hide');
            }
        });
    }

}


function clicou() {

    $('#file_upload_perfil').click();
}


function editPerfil() {
    $('#buscarLogradouro').hide();
    $("#getTableIntes tbody").html('');
    $("#getTableIntes tbody").html('<tr><td colspan="4" aling="center"><img src="/img/loadings/ajax-loader.gif" /></td></tr>');

    var image = $("div#new").find("img").attr("src");
    var estado = $("#estado").val();
    var nomeCompleto = $("#nomeCompleto").val();
    var email = $("#email").val();
    var cidade = $("#cidade").val();

    var data = {image: image, estado: estado, cidade: cidade, email: email, nomeCompleto: nomeCompleto, email: email};
    var formURL = $(this).attr("action");
    $('#retorno').fadeOut();

    $.ajax({
        type: 'POST',
        url: '/ws/perfil/edit/',
        data: data,
        dataType: 'json',
        success: function(data) {

            $("#getTableIntes tbody").html('');
            $('#loading').modal('hide');

            if (data.result == true) {
                $("#getTableIntes tbody").html('<tr><td aling="center"><h1> Perfil Atualizado com sucesso.</h1></td></tr>');
            } else {
                $("#getTableIntes tbody").html('<tr><td aling="center"><h1> Falha ao Atualizar o Perfil.</h1></td></tr>');
            }
        }, error: function(data) {
            $("#getTableIntes tbody").html('');
            $('#loading').modal('hide');
            $("#getTableIntes tbody").html('<tr><td  aling="center"><h1> Falha ao Atualizar o Perfil.</h1></td></tr>');
        }
    });

}