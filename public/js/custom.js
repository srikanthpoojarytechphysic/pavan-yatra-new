$(document).ready(function(){
    $(".flightloader").submit(function () {

    });

    $(document).on('click', '.number-spinner a', function () {
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		newVal = 0;
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
    $(".children_select").show();
    if(newVal>1)
    {
      $(".children_select").append('<select class="child_age'+newVal+'" name="child_age'+newVal+'"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select>');
    }
	} else {
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
});
