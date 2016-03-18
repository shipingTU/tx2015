

function loadImage(obj){
	if(obj.width/obj.height >= 3/2){
		obj.width = obj.parentElement.clientWidth;
	}else{
		obj.height = obj.parentElement.clientHeight;	
	}
};
function initSlider(idSlider) {
	var slideCount = $(idSlider +' ul li').length;
	var slideWidth = $(idSlider +' ul li').width();
	var slideHeight = $(idSlider +' ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	$(idSlider).css({ width: slideWidth, height: slideHeight });	
	$(idSlider +' ul').css({ width: sliderUlWidth });				
	$(idSlider +' ul li:last-child').prependTo(idSlider +' ul');
};

function moveRight(idSlider) {

	$(idSlider+ ' ul').animate({
		left: - $(idSlider+ ' ul li').width()
		}, 500, function () {
		$(idSlider+ ' ul li:first-child').appendTo(idSlider+ ' ul');
		$(idSlider+ ' ul').css('left', '');
	});
};
