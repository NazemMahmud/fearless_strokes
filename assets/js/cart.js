'use strict';
$(document).ready(function(){
     function cartAction(action, product_id){
              var serial = document.getElementById("showserial").value;
              var size = document.getElementById("showsize").value;
              var qty = document.getElementById("quantity").value;
              alert('2nd'+product_id+action+serial+'size'+size);
              
              var queryString = "";
                if(action != "") {
                    switch(action) {
                        case "add":
                            queryString = 'action='+action+'&code='+ product_id+'&serial='+serial+'&quantity='+qty+'&size='+size;
            //                document.getElementById("cartcount").innerHTML = count;
                            alert(queryString);
                        break;
                        case "remove":
                            alert("working");
                            queryString = 'action='+action+'&code='+ product_code;
                        break;
                        case "empty":
                            queryString = 'action='+action;
                        break;
                    }	 
                }
                jQuery.ajax({
                url: "ajax_action.php",
                data:queryString,
                type: "POST",
                success:function(data){
                    alert("success");
                    $("#cartcount").html(data);
                    if(action != "") {
            //            alert("success");
                        switch(action) {
                            case "add":
                                count++;
                                document.getElementById("cartcount").innerHTML = count;
            //					$("#add_"+product_code).hide();
            //					$("#add_"+product_code).value = "Added";
            //					$("#added_"+product_code).show();
                            break;
                            case "remove":
                                $("#add_"+product_code).show();
                                $("#added_"+product_code).hide();
                            break;
                            case "empty":
                                $(".btnAddAction").show();
                                $(".btnAdded").hide();
                            break;
                        }	 
                    }
                },
                error:function (){alert("error");}
                });
          }
});