function getData()
{
    $('#price-total').html('<i class="fa fa-spinner fa-pulse"></i>'); 
    getPaper();
}

function calculate(responce) 
{ 
    var good = false;
    numberPaper = $('#calc-numberpaper').val(); 
    
    //  высчитываем лучший вариант
    w = +$('#calc-width').val() + +$('#indent').val();
    h = +$('#calc-height').val() + +$('#indent').val();

    if( $('#calc-chromaticity').val() != $('#calc-chromaticity2').val() ) {
        $('#calc-himself').attr("disabled", true);
        $('#calc-himself').removeAttr("checked");

    }
    else {
        $('#calc-himself').attr("disabled", false);
    }

    listW = responce.width;
    listH = responce.height;

    if(w > 5 && h > 5)
    {
        a1 = listW / w;
        a2 = listH / h;
        b1 = listW / h;
        b2 = listH / w;
        if( $("#calc-himself").prop('checked') )
        {
            var biggest =  listW > listH ? listW : listH;
            a2 = (biggest / 2) / h;
            b2 = (biggest / 2) / w;
        }

        A = Math.floor(a1) * Math.floor(a2);
        B = Math.floor(b1) * Math.floor(b2);
        var best =  A > B ? A : B;

        if( $("#calc-himself").prop('checked') )
        {
            best = best * 2;
        }

        good = true;

        // печатный лист
        printerList = numberPaper / best;
        printerList = Math.ceil(printerList);

        // Высчитываем цену листа
        price = printerList * responce.price;
        percent = price * responce.percent / 100;
        tmpPrice = price + percent;

        // цветность
        chromaticity = +$('#calc-chromaticity').val() + +$('#calc-chromaticity2').val();

        //  стоимость работ на офсете
        priceOffset = chromaticity * $('#priceRun').val() * printerList;

        // Печатные формы
        if( $("#calc-himself").prop('checked') )
        {
            col_form = chromaticity / 2;
            summaPrintForm = $('#pricePrintingPlate').val() * col_form;
        } 
        else 
        {  
            summaPrintForm = $('#pricePrintingPlate').val() * chromaticity;
        }

        totalPrice = tmpPrice + priceOffset + summaPrintForm;

        good = true;
    }
    else
    {
        $('#price-total').html(''); 
    }
    
    
    
    if( good == true ) {
        $('#price-total').html('Цена: <b>' + totalPrice + '</b> &#8381;'); 
    }
}

function getPaper()
{	
	$.post(
        "site/default/getpaper", {
        	id : $('#calc-paper').val()
        },
        function (data) {
        	calculate(jQuery.parseJSON(data));
        }
    )
}