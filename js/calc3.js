function getData()
{
    $('#price-total').html('<i class="fa fa-spinner fa-pulse"></i>'); 
    getPaper();
}

function calculate(responce) 
{ 
    var good = false;
    numberPaper = $('#calc3-numberpaper').val(); 

    $("#unit_tmp").val($("#calc3-unit").val());

    //  format
    if($("#calc3-format").val() != 0)
    {
        w = $("#" + $("#calc3-format").val() + "").attr('data-width');
        h = $("#" + $("#calc3-format").val() + "").attr('data-height');
         //metr
        if($("#calc3-unit").val() == 0)
        {
            w = w / 100;
            h = h / 100;
        }
        //mm
        if($("#calc3-unit").val() == 1000000)
        {
            w = w * 10;
            h = h * 10;
        }
        $("#calc3-width").val(w).attr("readonly", true);
        $("#calc3-height").val(h).attr("readonly", true);
    }
    else
    {
        $("#calc3-width").attr("readonly", false);
        $("#calc3-height").attr("readonly", false);  
    }

    if($("#calc3-unit").val() != 0) 
    {
        k = $("#calc3-width").val() * $("#calc3-height").val() / $("#calc3-unit").val();
    }
    else
    {
        k = $("#calc3-width").val() * $("#calc3-height").val();
    }
    
    p1 = k * responce.price;
    p2 = p1 * numberPaper;
    totalPrice = p2 ;
    totalPrice = Math.floor(totalPrice);

    if($("#calc3-width").val() > 0 && $("#calc3-height").val() > 0 && numberPaper > 0)
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
        "site/default/getpaper3", {
        	id : $('#calc3-paper').val()
        },
        function (data) {
        	calculate(jQuery.parseJSON(data));
        }
    )
}


function getUnit()
{
    //mm
    if($("#calc3-unit").val() == 1000000)
    {
        if($("#unit_tmp").val() == 10000)
        { 
            newW = +$("#calc3-width").val() * 10; 
            newH = +$("#calc3-height").val() * 10; 
        }
        if($("#unit_tmp").val() == 0)  
        { 
            newW = +$("#calc3-width").val() * 1000; 
            newH = +$("#calc3-height").val() * 1000; 
        }
       
        $("#unit_tmp").val( +$("#calc3-unit").val() );
        $("#calc3-width").val( newW );
        $("#calc3-height").val( newH );
        exit();
    }

    //  cm
    if($("#calc3-unit").val() == 10000)
    {
        if($("#unit_tmp").val() == 1000000) 
        { 
            newW = +$("#calc3-width").val() / 10; 
            newH = +$("#calc3-height").val() / 10; 
        }
        if($("#unit_tmp").val() == 0) 
        { 
            newW = +$("#calc3-width").val() * 100; 
            newH = +$("#calc3-height").val() * 100; 
        }
       
        $("#unit_tmp").val( $("#calc3-unit").val() );
        $("#calc3-width").val( newW );
        $("#calc3-height").val( newH );
        exit();
    }

    //metr
    if($("#calc3-unit").val() == 0)
    {
        if($("#unit_tmp").val() == 1000000) 
            { 
                newW = +$("#calc3-width").val() / 1000; 
                newH = +$("#calc3-height").val() / 1000; }
        if($("#unit_tmp").val() == 10000) 
            { 
                newW = +$("#calc3-width").val() / 100; 
                newH = +$("#calc3-height").val() / 100; 
            }   
        $("#unit_tmp").val($("#calc3-unit").val());
        $("#calc3-width").val( newW );
        $("#calc3-height").val( newH );
        exit();
    }
}
