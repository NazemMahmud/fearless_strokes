$(document).ready(function () {
    // var action = 'remove';
    $( ".singleCartRemove").click(function(e) { //when user clicks on cart box

        var serialcode = $(this).attr("data-code");

        var queryString = 'code='+ serialcode;
        // alert(queryString);
        $.ajax({ //make ajax request to cart_process.php
            url: "ajax_delete.php",
            type: "POST",
            dataType:"json", //expect json value from server
            data: queryString
        }).done(function(data){ //on Ajax success
                 // alert("success");
            $("#cartcount").html(data.pcode); //total items in cart-info element
            location.reload();

        })

    });

});