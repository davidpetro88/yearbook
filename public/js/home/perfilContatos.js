/**
 * @author David Abraão
 * @version 1.0
 */

$(document).ready(function() {

    $('#loading').modal('show');

    $.ajax({
        type: 'POST',
        url: '/ws/perfil/finduser/username/' + username + '',
        dataType: 'json',
        success: function(data) {

            if (data.result === 'error') {
                $('#formPerfil').hide();
                $('#nao_encontrado').html('<h1> Usuário não econtrado </h1>');
            } else {

                $('#new').html('<div id="img_profile" class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 260px; line-height: 10px;">\n\
                                    <img id="img_upload" name="img_upload" style="max-height: 250px;" src="' + data.arquivoFoto + '">\n\
                                </div>');

                $('#user_result').html('<input type="text"  class="form-control" value="' + data.username + '" id="inputStandard" readonly>');

                $('#name_result').html('<input type="text"  class="form-control" value="' + data.nomeCompleto + '" id="inputStandard" readonly>');

                $('#email_user').html('<input type="text"  class="form-control" value="' + data.email + '" id="inputStandard" readonly>');

                $('#result_uf').html('<input type="text"  class="form-control" value="' + data.sigaEstado + '" id="inputStandard" readonly>');

                $('#result_cidade').html('<input type="text"  class="form-control" value="' + data.nomeCidade + '" id="inputStandard" readonly>');
            }
            setTimeout(function() {
                $('#loading').modal('hide');
            }, 450);

        }, error: function(data) {

            setTimeout(function() {
                $('#loading').modal('hide');
            }, 450);
        }
    });

});