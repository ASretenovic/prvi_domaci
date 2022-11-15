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
    



// ------------------------------------- Kategorija ------------------------------------------------------------


    // Ucitavanje svih kategorija u padajucu listu
    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
            data: {getCategory: 1},
            success: function(data){
                var choose = "<option value=''>Izaberite kategoriju:</option>";
                $("#select_cat").html(choose + data);
            }
        })
    }


    // Nova kategorija
    $("#category_form").on("submit",function(){
        if($("#category_name").val() == ""){
            $("#category_name").addClass("border-ranger");
            $("#cat_error").html("<span class='text-danger'>Unesite naziv kategorije!</span>");
        }else{
            $.ajax({
                url: DOMAIN + "/handler/process.php",
                method: "POST",
                data: $("#category_form").serialize(),
                success: function(data){
                    if(data == "CATEGORY_ADDED"){
                        $("#category_name").removeClass("border-ranger");
                        $("#cat_error").html("<span class='text-success'>Kategorija je uspešno dodata.</span>");
                        $("#category_name").val("");
                        fetch_category();
                    } else{
                        alert(data);
                    }
                }
            })
        }
    })


    // Tabelarni prikaz svih kategorija
    manageCategory();
    function manageCategory(){
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
                data: {manageCategory:1},
                success: function(data){
                    $("#get_category").html(data);
                }
        }) 
    }

    
// ----------------------------------------------- Proizvod --------------------------------------------------
   
     // Novi proizvod
    $("#product_form").on("submit",function(){
        //console.log("test0");
        if($("#product_name").val() == ""){
            //console.log("test1");
            $("#product_name").addClass("border-ranger");
            $("#pro_error").html("<span class='text-danger'>Unesite naziv proizvoda!</span>");
        }else{
            //console.log("test2");
            $.ajax({
                url: DOMAIN + "/handler/process.php",
                method: "POST",
                data: $("#product_form").serialize(),
                success: function(data){
                    if(data == "PRODUCT_ADDED"){
                        //console.log("test3");
                        $("#product_name").removeClass("border-ranger");
                        $("#pro_error").html("<span class='text-success'>Proizvod je uspešno dodat.</span>");
                        $("#product_name").val("");
                        $("#product_stock").val("");
                        $("#product_price").val("");
                        $("#select_cat").val("");
                    } else{
                        alert(data);
                    }
                }
            })
        }
    })


    // Tabelarni prikaz svih proizvoda
    manageProducts();
    function manageProducts(){
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
                data: {manageProducts:1},
                success: function(data){
                    $("#get_product").html(data);
                }
        })
    }
  

})