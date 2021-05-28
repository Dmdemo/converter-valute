    $("#val").bind("change paste keyup", function() {
        if ($("#val").val()!=''){
            sendconvertval()
            showlog()
        } else {
            $("#res").val('') 
        }
    });

    $("#valfrom").on("change", function() {
        $("#val").val('')
        $("#res").val('') 
    });

    $("#valto").on("change", function() {
        $("#val").val('')
        $("#res").val('') 
    });

    $("#showlog").on("click", function() {

        if ($("#log").css("display")!="none"){
            $("#log").hide() 
            $("#setting").hide()
        } else{
            $("#setting").hide()
            showlog()
            $("#log").show() 
        }
        return false;
    });

    $("#showsetting").on("click", function() {

        if ($("#setting").css("display")!="none"){
            $("#setting").hide()
            $("#log").hide() 
        } else{
            $("#log").hide()
            showSettings()
            $("#setting").show() 
        }
        return false;
    });


function sendconvertval(){

        $.ajax({
            url: '/calcres.php', 
            method: 'post',            
            dataType : "json",  
            data: {'val' : $('#val').val(), 'valfrom': $('#valfrom').val(),'valto': $('#valto').val() },                   
            success: function (data, textStatus) { 
                 $("#res").val(data['res']); 
            },
            error: function (jqXHR, exception) {
                 alert('Uncaught Error. ' + jqXHR.responseText + exception);
            }
        });

}

function showlog(){

    $.ajax({
        url: '/showlog.php', 
        method: 'post',            
        dataType : "text",  
        success: function (data, textStatus) { 
            
            $("#logarea").html(data)
        },
        error: function (jqXHR, exception) {
             alert('Uncaught Error. ' + jqXHR.responseText + exception);
        }
    });

}

function showSettings(){

    $.ajax({
        url: '/showset.php', 
        method: 'post',            
        dataType : "json",  
        success: function (data, textStatus) { 
            console.log(data['count'])
            console.log(data['arr'])
            $("#countsetting").val(data['count'])
        },
        error: function (jqXHR, exception) {
             alert('Uncaught Error. ' + jqXHR.responseText + exception);
        }
    });

}

