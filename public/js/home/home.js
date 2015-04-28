/**
 * @author David Abraão
 * @version 1.0
 */

$(document).ready(function() {
    $('#loading').modal('show');


    if (lasProfile != 0) {

        lastProfileSee(lasProfile);

    }


    //Init jquery spinner init - default
    $("#chosen-list1").chosen();


    setTimeout(function() {
        $('#loading').modal('hide');
    }, 450);
});

function lastProfileSee(data) {

    data = JSON.parse(data);

    $('#loadLastPerfilResult').html('<div class="col-md-12">\n\
                    <div class="panel profile-panel">\n\
                        <div class="panel-heading">\n\
                            <div class="panel-title"> <i class="fa fa-user"></i> Ultimo Perfil Visualizado  </div>\n\
                            <div class="panel-btns pull-right margin-left">\n\
                                <div class="btn-group">\n\
                                    <ul class="dropdown-menu checkbox-persist pull-right text-left" role="menu" id="text_new">\n\
                                        <li><a><i class="fa fa-envelope-o"></i> Message </a></li>\n\
                                        <li><a><i class="fa fa-user"></i> Add Friend </a></li>\n\
                                    </ul>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                        <div class="panel-body" style="z-index: 0;">\n\
                            <div class="row">\n\
                                <div class="col-xs-5" id="profile-avatar"> <img src=" ' + data.arquivoFoto + '" class="img-responsive" width="150" height="112" alt="avatar" /> </div>\n\
                                <div class="col-xs-7">\n\
                                    <div class="profile-data"> <span class="profile-name"> <b class="text-primary"> ' + data.nomeCompleto + ' </b></span> <span class="profile-email"> ' + data.email + ' </span>\n\
                                        <ul class="profile-info list-unstyled">\n\
                                            <li><i class="fa fa-globe"></i> ' + data.nomeCidade + ', ' + data.sigaEstado + '</li>\n\
                                        </ul>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <div class="clearfix"></div>\n\
                        </div>\n\
                        <div class="panel-footer">\n\
                            <div class="row"></div>\n\
                        </div>\n\
                    </div>');




}