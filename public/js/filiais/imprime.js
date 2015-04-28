/**
 * @author Abel Lopes
 * @version 1.0
 */

$(document).ready(function() {
    
    $('#result').hide();

    //Init jquery Date Picker
    $('.datepicker').datepicker()

    //Init jquery Date Range Picker
    $('input[name="daterange"]').daterangepicker();

    $('#encontrarPedido').submit(function(e) {
        var formURL = $(this).attr("action");
        $.ajax({
            type: 'POST',
            url: formURL,
            data: $('#encontrarPedido').serialize(),
            //dataType: 'json',
            success: function(data) {
                $('#result').fadeIn(200);
                $("#MydataTable tbody").html(data);
            }, error: function(data) {
            }
        });
////	e.unbind(); //unbind. to stop multiple form submit.
        e.preventDefault(); //STOP default action
    });



    $("#selectall").click(function() {
        $('.td').attr('checked', this.checked);
        alert("You have selected all boxes");
    });
    $(".td").click(function() {
        alert("You have checked  " + $(".td:checked").length + "  boxes");
        if ($(".td").length == $(".td:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });






});