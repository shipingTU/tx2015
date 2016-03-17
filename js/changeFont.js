$(document).ready(function () {
var taille = 15;
var augmentation = 1;
var tailleMax = 20;
var tailleMin= 10;
$('#agrandir').closest('span').click(function () {
taille +=1;
if (taille >= tailleMax)
{
taille = tailleMax;
}
$('#main').stop().animate({fontSize: taille+"px"},300);
});
$('#diminuer').closest('span').click(function () {
taille -=1;
if (taille <= tailleMin)
{
taille = tailleMin;
}
$('#main').stop().animate({fontSize: taille+"px"},300);
});
});
