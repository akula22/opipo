function getData()
{
    $('#price-total').html('<i class="fa fa-spinner fa-pulse"></i>'); 
    getPaper();
}

function calculate(responce) 
{ 
    var good = false;
    numberPaper = $('#calc2-numberpaper').val(); 

    $("#unit_tmp").val($("#calc2-unit").val());

    //  format
    if($("#calc2-format").val() != 0)
    {
        w = $("#" + $("#calc2-format").val() + "").attr('data-width');
        h = $("#" + $("#calc2-format").val() + "").attr('data-height');
         //metr
        if($("#calc2-unit").val() == 0)
        {
            w = w / 100;
            h = h / 100;
        }
        // //sm
        // if($("#calc2-unit").val() == 10000)
        // {
        //     w = w / 100;
        //     h = h / 100;
        // }
        //mm
        if($("#calc2-unit").val() == 1000000)
        {
            w = w * 10;
            h = h * 10;
        }
        $("#calc2-width").val(w).attr("readonly", true);
        $("#calc2-height").val(h).attr("readonly", true);
    }
    else
    {
        $("#calc2-width").attr("readonly", false);
        $("#calc2-height").attr("readonly", false);  
    }

    if($("#calc2-unit").val() != 0) 
    {
        k = $("#calc2-width").val() * $("#calc2-height").val() / $("#calc2-unit").val();
    }
    else
    {
        k = $("#calc2-width").val() * $("#calc2-height").val();
    }
    
    p1 = k * responce.price;
    p2 = p1 * numberPaper;
    totalPrice = p2 + responce.min_price;
    totalPrice = Math.floor(totalPrice);

    if($("#calc2-width").val() > 0 && $("#calc2-height").val() > 0 && numberPaper > 0)
    {
       $('#price-total').html('Цена: <b>' + totalPrice + '</b> &#8381;'); 
    }
    else
    {
        $('#price-total').html(''); 
    }
    
}

function getPaper()
{	
	$.post(
        "site/default/getpaper2", {
        	id : $('#calc2-paper').val()
        },
        function (data) {
        	calculate(jQuery.parseJSON(data));
        }
    )
}


function getUnit()
{
    //mm
    if($("#calc2-unit").val() == 1000000)
    {
        if($("#unit_tmp").val() == 10000)
        { 
            newW = +$("#calc2-width").val() * 10; 
            newH = +$("#calc2-height").val() * 10; 
        }
        if($("#unit_tmp").val() == 0)  
        { 
            newW = +$("#calc2-width").val() * 1000; 
            newH = +$("#calc2-height").val() * 1000; 
        }
       
        $("#unit_tmp").val( +$("#calc2-unit").val() );
        $("#calc2-width").val( newW );
        $("#calc2-height").val( newH );
        exit();
    }

    //  cm
    if($("#calc2-unit").val() == 10000)
    {
        if($("#unit_tmp").val() == 1000000) 
        { 
            newW = +$("#calc2-width").val() / 10; 
            newH = +$("#calc2-height").val() / 10; 
        }
        if($("#unit_tmp").val() == 0) 
        { 
            newW = +$("#calc2-width").val() * 100; 
            newH = +$("#calc2-height").val() * 100; 
        }
       
        $("#unit_tmp").val( $("#calc2-unit").val() );
        $("#calc2-width").val( newW );
        $("#calc2-height").val( newH );
        exit();
    }

    //metr
    if($("#calc2-unit").val() == 0)
    {
        if($("#unit_tmp").val() == 1000000) 
            { 
                newW = +$("#calc2-width").val() / 1000; 
                newH = +$("#calc2-height").val() / 1000; }
        if($("#unit_tmp").val() == 10000) 
            { 
                newW = +$("#calc2-width").val() / 100; 
                newH = +$("#calc2-height").val() / 100; 
            }   
        $("#unit_tmp").val($("#calc2-unit").val());
        $("#calc2-width").val( newW );
        $("#calc2-height").val( newH );
        exit();
    }
}
