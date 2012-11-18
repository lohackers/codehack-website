$(document).ready(function(){
	/** * * * * * * * *
	 * MAP CREATION 
	** * * * * * * * */

	var lngSpan = 45.56310;
	var latSpan = 12.42467;

	$('#map_canvas').gmap({
		'zoom': 13,
		'disableDefaultUI':true,
		'center': lngSpan+', '+latSpan,
		'mapTypeControl' : true,
	    'navigationControl' : true,
	    'streetViewControl' : true
	}).bind('init', function(evt, map) {

		$('#map_canvas').gmap('addControl', 'tags-control', google.maps.ControlPosition.TOP_LEFT);
		$('#map_canvas').gmap('addControl', 'radios', google.maps.ControlPosition.TOP_LEFT);

		var images = ['/bundles/codehackcommonassets/img/placemarker/fire.png'];
		var tags = ['jQuery', 'Google maps', 'Plugin', 'SEO', 'Java', 'PHP', 'C#', 'Ruby', 'JavaScript', 'HTML'];
		//$('#tags').append('<option value="all">All</option>');


		$('#map_canvas').gmap('addMarker', { 'icon': images[0], 'tags':'evento', 'bound':true, 'position': new google.maps.LatLng(lngSpan, latSpan) } ).click(function() {
			var content = '<h3>Treviso is on fire!!!!</h3><p>jdsfjhaskfa sdkjfa sldkjfha lskdjfha lksdjfha lksdfjhaslkdfh asd</p>';
			var visibleInViewport = (
				$('#map_canvas').gmap('inViewport', $(this)[0]) ) ? content : '';
				$('#map_canvas').gmap('openInfoWindow', { 'content': visibleInViewport }, this);
			});
	});

	/** * * * * * * * *
	 * PIE CHARTS CREATE
	** * * * * * * * */
    $('.percentage').easyPieChart({
      	animate: 1000
    });
    
    $('.percentage-light').easyPieChart({
      	size: 250,
       	barColor: '#ce2828',
       	trackColor: '#ff6565',
        scaleColor: false,
        lineCap: 'butt',
        lineWidth: 45,
        animate: 1000
    });

    //per aggiornare la label del valore utilizzare
    //$(ISTANZA_GRAFICO_'span').text(newValue+' %');
});

/** * * * * * * * *
 * HEADER ANIMATIONS
** * * * * * * * */

/* menu animation */
$(function() {
	jQuery("header nav li").hover(
		function(){
			jQuery(this).animate({
				'backgroundPosition': '-160px 0'
				}, 200, 'linear');
			if(jQuery(this).is(".current") || jQuery(this).is(".active")){
				jQuery(this).addClass("dark");
				}
			if(jQuery(this).prev().is(".current") || jQuery(this).prev().is(".active")){
				jQuery(this).addClass("bright");
				}
			},
		function(){
			jQuery(this).animate({
				'backgroundPosition': '0 0'
				}, 0, 'linear');
			if(jQuery(this).is(".dark")){
				jQuery(this).removeClass("dark");
				}
			if(jQuery(this).prev().is(".current") || jQuery(this).prev().is(".active")){
				jQuery(this).removeClass("bright");
				}
			});
	});

/** * * * * * * * *
 * AIUTO BUTTON ANIMATION
** * * * * * * * */
$(function(){
	$('.call-to-action_link').hover(function(){
		$(this).find('a').animate({'right':'72px'},{queue:false, duration:300});
		},
	function(){
		$(this).find('a').animate({'right':'80px'},{queue:false, duration:300});
		});
	});