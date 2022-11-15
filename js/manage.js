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


    // Prikaz svih kategorija u padajucoj listi
    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
            data: {getCategory: 1},
            success: function(data){
                var choose = "<option value=''>Choose category</option>";
                $("#select_cat").html(choose + data);
            }

        })
    }



// -------------------------------------------  Proizvod  --------------------------------------------------------

    // Tabelarni prikaz svih proizvoda                   
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



     // Prikaz modala za izmenu proizvoda kad se klikne na dugme "Izmeni"
     $("body").delegate(".edit_product","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
            dataType: "json",
            data: {updateProduct:1,pid:eid},
            success: function(data){
                $("#pid").val(data["pid"]);
                $("#update_product").val(data["naziv_proizvoda"]);
                $("#select_cat").val(data["kid"]);
                $("#product_price").val(data["cena_proizvoda"]);
                $("#product_stock").val(data["kolicina"]);
            }
        })
    })



    // Cuvanje izmena o proizvodu kada se klikne na "Izmeni" unutar modala
    $("#update_product_form").on("submit",function(){
        if($("#update_product").val() == ""){
            $("#update_product").addClass("border-ranger");
            $("#pro_error").html("<span class='text-danger'>Please enter category name</span>");
        }else{
            $.ajax({
                url: DOMAIN + "/handler/process.php",
                method: "POST",
                data: $("#update_product_form").serialize(),
                success: function(data){
                    if(data == "UPDATED"){
                        $("#update_product").removeClass("border-ranger");
                        $("#pro_error").html("<span class='text-success'>Proizvod je uspešno izmenjen.</span>");
                        $("#update_product").val("");
                        manageProducts();                    
                    } else{
                        alert(data);
                    }
                }
            })
        }
    })



    // Brisanje proizvoda
    $('body').delegate(".del_product","click",function(){
        var did = $(this).attr("did");              
        
        if(confirm("Da li ste sigurni da želite da izbrišete proizvod?")){
            $.ajax({
                url: DOMAIN + "/handler/process.php",
                method: "POST",
                data: {deleteProduct:1,pid:did},
                success: function(data){
                    if(data == "PRODUCT_DELETED"){
                        manageProducts();
                    } else if(data == "ERROR_DELETE_PRODUCT"){
                        alert("Greška prilikom brisanja proizvoda.");
                    } 
                }
            })
        }else{
        }
    })



    // Live search proizvoda
    $("#search_text").keyup(function(){
        var txt = $(this).val();
        
        if(txt == ''){
            $("#result").css("display", "none"); 
        }else{
            console.log("test");
            $.ajax({
                url: DOMAIN + "/handler/search.php",
                method: "POST",
                data: {search:txt},       
                success: function(data){
                    $("#result").html(data);
                    $("#result").show();
                }
            })
        }
    })




})