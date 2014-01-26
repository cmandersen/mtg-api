jQuery(document).ready(function($) {
	$(document).on("changeModal", function(e, args) {
		var increment = 0;
		if(args.keyCode == 37) {
			increment = -1;
		} else if(args.keyCode == 39) {
			increment = 1;
		}
		var nextIndex = null;
		$(".modal").each(function(index, elem) {
			if($(elem).hasClass('in')) {
				if((nextIndex = index + increment) == $(".modal").length) {
					nextIndex = 0;
				}
				$(elem).modal('hide');
				console.log(increment);
				console.log($(".modal").get(nextIndex));
				$($(".modal").get(index + increment)).modal('show');
				return false;
			}
		});
	});
	$(".modal").keydown(function(e) {
		if(e.keyCode == 37 || e.keyCode == 39)
			$(document).trigger("changeModal", e);
	});
});