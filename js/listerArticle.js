$(document).ready(function(){
	$('.resume').each(function () {
        var text = $(this).text();
        if(text.length > 100) {
            var begin = text.substr(0, 100)
            $(this).html(begin+" ... ");
        }
    });
});