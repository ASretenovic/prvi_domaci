$(document).ready(function(){

    var DOMAIN = "http://localhost:8080/GardeningWorld";



// -------------------------------------------- Kategorija --------------------------------------------------------
    
    // Tabelarni prikaz svih kategorija
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


    // Prikaz modala za izmenu kategorije kad se klikne na "Izmeni"
    $('body').delegate(".edit_cat","click", function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
            dataType: "json",
            data: {updateCategory:1, cid:eid},
            success: function(data){
                $("#cid").val(data["kid"]);
                $("#update_category").val(data["naziv_kategorije"]);
            }
        })
    })


    // Cuvanje promena kategorije kad se klikne na "Izmeni" unutar modala
    $("#update_category_form").on("submit",function(){

        if($("#update_category").val() == ""){
            $("#update_category").addClass("border-ranger");
            $("#cat_error").html("<span class='text-danger'>Unesite naziv kategorije!</span>");
        }else{
            $.ajax({
                url: DOMAIN + "/handler/process.php",
                method: "POST",
                data: $("#update_category_form").serialize(),
                success: function(data){
                    $("#update_category").removeClass("border-ranger");
                    $("#cat_error").html("<span class='text-success'>Kategorija je uspešno izmenjena.</span>");
                    $("#update_category").val("");
                    manageCategory();
                }
            })
        }
    })



    // Brisanje kategorije
    $('body').delegate(".del_cat","click",function(){
        var did = $(this).attr("did");             
        if(confirm("Da li ste sigurni da želite da izbrišete kategoriju?")){
            $.ajax({
                url: DOMAIN + "/handler/process.php",
                method: "POST",
                data: {deleteCategory:1,cid:did},
                success: function(data){
                    if(data == "CATEGORY_DELETED"){
                        manageCategory();
                        $("#get_category").html();                     
                    } else if(data == "DELETE_RESTRICTED"){
                        alert("Brisanje kategorije nije dozvoljeno jer sadrži proizvode.");
                    } else{
                        alert("Greška: brisanje kategorije nije uspelo.");
                    }
                }
            })
        }else{
            
        }
    })




})