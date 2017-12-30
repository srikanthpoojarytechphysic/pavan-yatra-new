$(document).ready(function(){
    $(".flightloader").submit(function () {

    });

    $(document).on('click', '.number-spinner a', function () {
	     var btn = $(this),
    		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
    		newVal = 0;
	if (btn.attr('data-dir') == 'up') {
    $('.children_select').show();

		newVal = parseInt(oldValue) + 1;
    $(".children_select").addClass('show-child-box');
    if(newVal>1)
    {
      $(".children_select").append('<select class="child_age'+newVal+'" name="child_age'+newVal+'"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select>');
    }
	}
  else
  {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
      $('.child_age'+oldValue).remove();
		}else if (oldValue == 1) {
      $('.child_age'+newVal).remove();
       $('.children_select').hide();
		}
    else if(oldValue == 0) {
			newVal = 0;
      $('.children_select').hide();
		}
	}
	btn.closest('.number-spinner').find('input').val(newVal);
});

//for adults box step increments
$(document).on('click', '.number-spinner-adult a', function () {
   var btn = $(this),
    oldValue = btn.closest('.number-spinner-adult').find('input').val().trim(),
    newVal = 0;
if (btn.attr('data-dir') == 'up') {
newVal = parseInt(oldValue) + 1;
if(newVal>1)
{
  // $(".children_select").append('<select class="child_age'+newVal+'" name="child_age'+newVal+'"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select>');
}
} else {
if (oldValue > 1) {
  newVal = parseInt(oldValue) - 1;
  $('.child_age'+oldValue).remove();
}else if (oldValue == 1) {
  $('.child_age'+newVal).remove();
}
else if(oldValue == 0) {
  newVal = 0;
}
}
btn.closest('.number-spinner-adult').find('input').val(newVal);
});


// for round trip flight jquery traversing
  var price_1;
  var price_2;
  var key_1;
  var key_2;
  var total_price;
   $(".type_1").on('click','.flight_type_1',function(){
       $(".sticky_flight").fadeIn(500).show();
       $(".flight_type_1").removeClass("red");
       $(this).addClass('red');
       var array =[];
       key_1 = $(this).attr('data-key');
       price_1 = $(this).attr('data-price');
        // get the current row
        var currentRow=$(this).closest("tr");

        total_price = parseInt(price_1)+parseInt(price_2);


        var airline_name=currentRow.find(".airline_name").text().replace(/\s/g,''); // get current row 1st TD value
        var airline_code=currentRow.find(".airline_code").text().replace(/\s/g,'');; // get current row 2nd TD
        var depart=currentRow.find(".depart").text().replace(/\s/g,''); // get current row 3rd TD
        var arrive=currentRow.find(".arrive").text().replace(/\s/g,''); // get current row 3rd TD
        var duration=currentRow.find(".duration").text().replace(/\s/g,''); // get current row 3rd TD
        var stop = currentRow.find(".stop_1").text();
        var stop_sec = currentRow.find(".stop_sec").text();
        $(".airline_name_type_1").html(airline_name);
        $(".airline_code_type_1").html(airline_code);
        $(".air_time_type_1").html(depart);
        $(".air_time_type_2").html(arrive);
        $(".duration_type_1").html(duration);
        $(".stop_type_1").html(stop).append('<br>'+stop_sec);
        $(".price_data_type").html('Rs.'+total_price);

        //set the book button to the redirect Route;

        $(".book_flight").attr("href","/flight/checkout/"+key_1+"/"+key_2);
   });

   //for tabel two
   $(".type_2").on('click','.flight_type_2',function(){
       $(".sticky_flight").fadeIn(500).show();
       $(".col_divider_2").fadeIn(500);
       var array =[];
       key_2 = $(this).attr('data-key');
       $(".flight_type_2").removeClass("red");
       $(this).addClass('red');
        // get the current row
        var currentRow=$(this).closest("tr");
        price_2 = $(this).attr('data-price');
        total_price = parseInt(price_1)+parseInt(price_2);

        var airline_name=currentRow.find(".airline_name").text().replace(/\s/g,''); // get current row 1st TD value
        var airline_code=currentRow.find(".airline_code").text().replace(/\s/g,'');; // get current row 2nd TD
        var depart=currentRow.find(".depart").text().replace(/\s/g,''); // get current row 3rd TD
        var arrive=currentRow.find(".arrive").text().replace(/\s/g,''); // get current row 3rd TD
        var duration=currentRow.find(".duration").text().replace(/\s/g,''); // get current row 3rd TD
        var stop = currentRow.find(".stop_2").text();
        var stop_sec_2 = currentRow.find(".stop_sec_2").text();
        $(".airline_name_type_2").html(airline_name);
        $(".airline_code_type_2").html(airline_code);
        $(".air_time_type_sec_1").html(depart);
        $(".air_time_type_sec_2").html(arrive);
        $(".duration_type_2").html(duration);
        $(".stop_type_2").html(stop).append('<br>'+stop_sec_2);
        $(".price_data_type").html('Rs.'+total_price);

        //set the book button to the redirect Route;

        $(".book_flight").attr("href","/flight/checkout/"+key_1+"/"+key_2);
   });
});
