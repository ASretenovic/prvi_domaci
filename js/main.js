$( document ).ready(function() {


    var DOMAIN = "http://localhost:8080/GardeningWorld";

    // ----------- Login
    $("#form_log").on("submit", function(){
        var email = $("#log_email");
        var password = $("#log_password");
        var status = false;
    
        if(email.val() != "" && password.val() != ""){
            status = true;
        }
    
        if(status){
           $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
            data: $("#form_log").serialize(),
            success: function(data){

                if(data == "USER_DOES_NOT_EXIST"){
                    $("#log_email").addClass("border-ranger");
                    $("#email_error").html("<span class='text-danger'>Email adresa ne postoji.</span>");
                } else if(data == "PASSWORD_NOT_MATCHED"){
                    $("#log_password").addClass("border-ranger");
                    $("#password_error").html("<span class='text-danger'>Neispravna lozinka. Pokušajte ponovo.</span>");
                } else{
                    window.location.href = encodeURI(DOMAIN + "/pocetna.php");
                }
            }
           })
        }
    }) 
    


    
})