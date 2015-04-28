/**
 * @author David Abraão
 * @version 1.0
 */

$(document).ready(function() {
    $('#loading').modal('show');


//Init jquery spinner init - default
    $("#chosen-list1").chosen();


    $.ajax({
        type: 'POST',
        url: '/ws/perfil/listusers/',
        dataType: 'json',
        success: function(data) {
            if (data.result == 'error') {

            } else {
                var getPerfis = '';
                $.each(data, function(k, v) {
                    getPerfis += '<tr class="odd">\n\
                                        <td class="text-center  sorting_1">\n\
                                            <img width="50" height="50" alt="avatar" src=" ' + v.arquivoFoto + '">\n\
                                        </td>\n\
                                        <td id="table-name" class="info "><b> ' + v.nomeCompleto + ' </b><br>\n\
                                            <span class="text-muted">\n\
                                                <i class="fa fa-map-marker"></i> ' + v.sigaEstado + ', ' + v.nomeCidade + '</span>\n\
                                        </td>\n\
                                        <td id="table-user" class=" "><i class="fa fa-user"></i> ' + v.username + '</td>\n\
                                        <td id="table-email" class="hidden-xs "><a class="semi-bold text-dark">' + v.email + '</a></td>\n\
                                        <td class="text-right text-center" ><div class="btn-group">\n\
                                                <button data-toggle="dropdown" class="btn btn-primary btn-gradient dropdown-toggle" type="button">\n\
                                                    <span class="glyphicons glyphicons-cogwheel"></span> Info\n\
                                                </button>\n\
                                                <ul role="menu" class="dropdown-menu checkbox-persist pull-right text-left">\n\
                                                    <li><a href="/home/perfil/perfil/username/' + v.username + '"><i class="fa fa-user"></i> View Profile </a></li>\n\
                                                </ul>\n\
                                            </div></td>\n\
                                    </tr>';
                });
                $('#list_perfil_users').html(getPerfis);

                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 300);
            }

        }, error: function(data) {

            setTimeout(function() {
                $('#loading').modal('hide');
            }, 300);
        }

    });


    $('#pesPerfil').click(function() {
        findUser();
    });

    $("#panelSearch").keyup(function(event) {

        if (event.keyCode == 13) {
            findUser();
        }
    });

});


function findUser() {
    $('#loading').modal('show');

    var nome = $('input[name=search_user]').val();
    if (nome == 'undefined') {
        nome = '';
    }

    $.ajax({
        type: 'POST',
        url: '/ws/perfil/find/nome/' + nome + '',
        dataType: 'json',
        success: function(data) {
            if (data.result == 'error') {

                getPerfis += '<tr class="odd">  <td colspan="6"><center><h3> Perfil não encontrado. </h3> </center> </td> </tr>';
                $('#list_perfil_users').html(getPerfis);

                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 300);

            } else {
                var getPerfis = '';
                $.each(data, function(k, v) {
                    getPerfis += '<tr class="odd">\n\
                                        <td class="text-center  sorting_1">\n\
                                            <img width="50" height="50" alt="avatar" src=" ' + v.arquivoFoto + '">\n\
                                        </td>\n\
                                        <td class="info "><b> ' + v.nomeCompleto + ' </b><br>\n\
                                            <span class="text-muted">\n\
                                                <i class="fa fa-map-marker"></i> ' + v.sigaEstado + ', ' + v.nomeCidade + '</span>\n\
                                        </td>\n\
                                        <td class=" "><i class="fa fa-user"></i> ' + v.username + '</td>\n\
                                        <td class="hidden-xs "><a class="semi-bold text-dark">' + v.email + '</a></td>\n\
                                        <td class="text-right text-center "><div class="btn-group">\n\
                                                <button data-toggle="dropdown" class="btn btn-primary btn-gradient dropdown-toggle" type="button">\n\
                                                    <span class="glyphicons glyphicons-cogwheel"></span> Info\n\
                                                </button>\n\
                                                <ul role="menu" class="dropdown-menu checkbox-persist pull-right text-left">\n\
                                                    <li><a href="/home/perfil/perfil/username/' + v.username + '"><i class="fa fa-user"></i> View Profile </a></li>\n\
                                                </ul>\n\
                                            </div></td>\n\
                                    </tr>';
                });
                $('#list_perfil_users').html(getPerfis);

                setTimeout(function() {
                    $('#loading').modal('hide');
                }, 300);
            }

        }, error: function(data) {

            setTimeout(function() {
                $('#loading').modal('hide');
            }, 300);
        }

    });



}