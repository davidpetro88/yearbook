
/**
 * @author David Abraão
 * @version 1.0
 */

$(document).ready(function() {

    // Init Theme Core 	  
    Core.init();

    loadUf();


    $('#submitFrom').click(function() {
        //$('input').click();
        saveUser();
    });


    $('#pesq_img').click(function() {
        //$('input').click();
        $('#file_upload_perfil').click();
    });

    $('#img_profile').click(function() {
        //$('input').click();
        $('#file_upload_perfil').click();
    });



});

function findCidade(idEstado) {

    if (idEstado == '') {
        return false;
    } else {
        $('#loading').modal('show');
        $.ajax({
            type: 'POST',
            url: '/login/index/cidades/estado/' + idEstado,
            dataType: 'json',
            success: function(data) {
                var option = '';
                $.each(data, function(k, v) {
                    option += '<option value="' + v.idCidade + '"> ' + v.nomeCidade + ' </option>';

                });

                $('#result_cidade').html('<label for="chosen-list1" class="col-md-4 control-label">Cidade <div style="float: right; margin-left: 5px; color:red">*</div> </label>\
                    <div class="col-md-8">\
                        <select class="form-control" id="cidade_form" name="cidade">\
                        <option > Selecione.. </option>\
                            ' + option + '\
                        </select>\
                        <label id="cidade_error" class="error" for="cidade" style="display:none;">Please enter a username</label>\
                    </div>');


                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 600);
                ;
                $('#result_cidade').fadeIn(200);

            },
            error: function(data) {

                $('#loading').modal('hide');
            }
        });
    }
}



function loadUf() {

    $('#loading').modal('show');

    $.ajax({
        type: 'POST',
        url: '/login/index/loaduf/',
        dataType: 'json',
        success: function(data) {
            var option = '';
            $.each(data, function(k, v) {
                option += '<option value="' + v.idEstado + '"> ' + v.sigaEstado + ' -' + v.nomeEstado + ' </option>';
            });

            $('#result_uf').html('<label for="chosen-list1" class="col-md-4 control-label">Estado<div style="float: right; margin-left: 5px; color:red">*</div> </label>\
                    <div class="col-md-8">\
                        <select class="form-control" id="estado_form" name="estado" onchange="findCidade(this.value);">\
                        <option > Selecione.. </option>\
                            ' + option + '\
                        </select>\
                            <label class="error" id="estado_error" for="username" style="display:none;">Selecione um estado.</label>\n\
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


function saveUser() {
    $('#buscarLogradouro').hide();
    $("#getTableIntes tbody").html('');
    $("#getTableIntes tbody").html('<tr><td colspan="4" aling="center"><img src="/img/loadings/ajax-loader.gif" /></td></tr>');
    $('#username_error').hide();
    $('#estado_error').hide();
    $('#nome_error').hide();
    $('#password_error').hide();
    $('#confirm_password_error').hide();
    $('#email_error').hide();

    var image = $("div#new").find("img").attr("src");
    var username = $('#username_form').val();
    var nome = $('#nomeCompleto_form').val();
    var estado = $("#estado_form").val();
    var cidade = $("#cidade_form").val();
    var password = $('#password_form').val();
    var email = $('#email_form').val();

    var postValue = 0;


    if (cidade == 'Selecione..') {
        $('#cidade_error').show();

        postValue = 1;
    }


    if (username == '') {
        $('#username_error').show();

        postValue = 1;
    }

    if (estado == 'Selecione..') {
        $('#estado_error').show();
        postValue = 1;
    } else {

    }

    if (nome == '') {
        $('#nome_error').show();
        postValue = 1;
    } else {

    }

    if (password == '') {
        $('#password_error').show();
        postValue = 1;
    } else {
    }


    if (email == '') {
        $('#email_error').show();
        postValue = 1;
    } else {

    }

    if (postValue == 0) {

        var data = {username: username, nome: nome, estado: estado, password: password, email: email, image: image, cidade: cidade};
        $.ajax({
            type: 'POST',
            url: '/login/index/save/',
            data: data,
            dataType: 'json',
            success: function(data) {
                $("#getTableIntes tbody").html('');

                if (data.result == 1) {
                    $("#getTableIntes tbody").html('<tr><td  aling="center"><h1> Conta criada com sucesso.</h1></td></tr>');
                } else {
                    $("#getTableIntes tbody").html('<tr><td  aling="center"><h1> Falha ao Atualizar o Perfil.</h1></td></tr>');
                }
            }, error: function(data) {
                $("#getTableIntes tbody").html('');
                $('#loading').modal('hide');
                $("#getTableIntes tbody").html('<tr><td  aling="center"><h1> Falha ao Atualizar o Perfil.</h1></td></tr>');
            }
        });

    } else {
        $("#getTableIntes tbody").html('');
        $('#loading').modal('hide');
        $("#getTableIntes tbody").html('<tr><td  aling="center"><h1> Falha ao Atualizar o Perfil.</h1></td></tr>');
    }

//    var password = $('#password');
//
//    var image = $("div#new").find("img").attr("src");
//    var estado = $("#estado").val();
//    var nomeCompleto = $("#nomeCompleto").val();
//    var email = $("#email").val();
//    var cidade = $("#cidade").val();
//
//    if (estado == 'Selecione..') {
//        $('#estado_error').show();
//    }
//
//    if (nomeCompleto == '') {
//        $('#nome_error').show();
//    }
//
//    alert(nomeCompleto);

}