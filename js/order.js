$( document ).ready(function() {


    var DOMAIN = "http://localhost:8080/GardeningWorld";


    //  Dodavanje nove stavke u porudzbinu 
    addNewRow();
    $("#add").click(function(){
        addNewRow();
    })


    function addNewRow(){
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
            data: {getNewOrderItem:1},
            success: function(data){
                $("#invoice_item").append(data);
                var n = 0;
                $(".number").each(function(){
                    $(this).html(++n);
                })
            }
        })
    }


    // Brisanje stavke iz porudzbine

    $("#remove").click(function(){
        $("#invoice_item").children("tr:last").remove();     
        calculate();                                         
    })



    // Prikaz podataka o proizvodu nakon izbora iz padajuce liste 

    $("#invoice_item").delegate(".pid","change",function(){
        var pid = $(this).val();
        var tr = $(this).parent().parent();  
        $(".overlay").show();
        $.ajax({
            url: DOMAIN + "/handler/process.php",
            method: "POST",
            dataType: "json",
            data: {getPriceAndQty:1,id:pid},
            success: function(data){
                tr.find(".tqty").val(data["kolicina"]);     
                tr.find(".pro_name").val(data["naziv_proizvoda"]);  
                tr.find(".qty").val(1);                        
                tr.find(".price").val(data["cena_proizvoda"]);   
                tr.find(".amount").html(tr.find(".qty").val() * tr.find(".price").val());   
                calculate();                                                          
            }
        })
    })


    // Kontrola unosa u polje "kolicina"
    $("#invoice_item").delegate(".qty","keyup",function(){
        var qty = $(this);                               
        var tr = $(this).parent().parent();              
        
        if(isNaN(qty.val())){
            alert("Količina mora biti pozitivan broj.");
            qty.val(1);
        } else{
            if(qty.val() >= 0){
                tr.find(".amount").html(qty.val() * tr.find(".price").val());
                calculate();      
            } else{
                alert("Količina mora biti pozitivan broj!");
            }
        }
    })




    // Ukupna cena
    function calculate(){
        var sub_total = 0;
        var pdv = 0;
        var net_total = 0;
        $(".amount").each(function(){
            sub_total = sub_total + ($(this).html()*1);  
        })

        pdv = 0.2 * sub_total;
        net_total = sub_total + pdv;
        $("#sub_total").val(sub_total);
        $("#pdv").val(pdv);
        $("#net_total").val(net_total);
    }



    // Cuvanje narudzbine u bazi
    $("#order_form").click(function(){
        var employee_name = $("#employee_name").val();
        if(employee_name == ""){
        } else{
            $.ajax({
                url: DOMAIN + "/handler/process.php",
                method: "POST",
                data:$("#get_order").serialize(),
                success: function(data){
                        if(data == "INVOICE_INSERTED"){
                            alert("Narudzbina je sacuvana.");
                            $("#employee_name").val("");
                        } else{ 
                            alert(data);     
                        }
                }
            })
        }
    })


})