var images = ['/bundles/codehackcommonassets/img/placemarker/fire.png','/bundles/codehackcommonassets/img/placemarker/innonda.png','/bundles/codehackcommonassets/img/placemarker/terremoto.png'];

$(document).ready(function(){
    /** * * * * * * * *
     * MAP CREATION
    ** * * * * * * * */

    var lngSpan = 45.55310;
    var latSpan = 12.40467;


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

        
        var tags = ['jQuery', 'Google maps', 'Plugin', 'SEO', 'Java', 'PHP', 'C#', 'Ruby', 'JavaScript', 'HTML'];
        //$('#tags').append('<option value="all">All</option>');


            $('#map_canvas')
            .gmap('addMarker', {
                'icon': images[1],
                'tags':'evento',
                'bound':true,
                'position': new google.maps.LatLng(lngSpan, latSpan)
            })
            .click(function() {
                var content = '<h3>Treviso is on fire!</h3><p>Necessari 2000€</p>';
                var visibleInViewport = (
                    $('#map_canvas').gmap('inViewport', $(this)[0]) ) ? content : '';
                    $('#map_canvas').gmap('openInfoWindow', { 'content': visibleInViewport }, this);
            });
    });





    // $('#map_canvas').gmap({ 'center':latlng, 'callback': function() {
 //            $('#map_canvas').gmap('loadJSON', '/bundles/codehackcommonassets/json/markers.json', 'category=activity', function(i, m) {
 //                $('#map_canvas').gmap('addMarker', { 'position': new google.maps.LatLng(m.lat, m.lng) } );
 //            });
 //        }
 //    });






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


// DEFAULT SOCKET IO
$(document).ready(function() {

    /*
    * Functions
    */

    function log(msg) {
        console.log(new Date().toJSON() +": "+ msg);
    }

    function toggleDebug(spd) {
        var speed = spd || 'fast';
    
        defaultDebug.fadeToggle(speed);
        defaultDebug.toggleClass("active");
        if (defaultDebug.hasClass("active")) {

        } else {

        }
    }

    function insertDebug() {
        status = $('<div/>', {
            id: 'status'
        });
        
        clientId = $('<div/>', {
            id: 'clientId'
        });

        tot = $('<span/>', {
            id: 'tot',
            text: '0'
        });

        online = $('<div/>', {
            id: 'online',
            text: ' players online.'
        });

        online.prepend(tot);

        defaultDebug = $('<div/>', {
            id: 'default-debug'
        }).append( status )
          .append( clientId )
          .append( online );

        $('body').append( defaultDebug );
    }

    function init() {
        insertDebug();

        status.html("Connecting...");

        $(document).keyup(function(e) {
            if (e.keyCode === 220) { //backslash
                toggleDebug();
            }
        });
    }

    /*
    * Main
    */

    // var socket = new io.connect(window.location.origin);
    var socket = new io.connect('http://10.1.89.15:8001');
    
    var status,
        clientId,
        online,
        tot,
        defaultDebug;

    var player = new Player(),
        players = [];
        
    init();

    /*
    * Socket.IO
    */

    socket.on('connect', function() {
        status.html("Connected.");
        log("Connected.");
    });

    socket.on('disconnect', function() {
        status.html("Disconnected.");
        log("Disconnected.");
    });

    socket.on('tot', function(data) {
        tot.html(data.tot);
        log("Current players number: "+ data.tot);
    });

    socket.on('join', function(data) {
        player = jQuery.extend(true, {}, data.player);

        clientId.html(data.player.id);

        log('You have joined the server. (id: '+ data.player.id +').');
    });

    socket.on('quit', function(data) {
        var quitter = '';

        var length = players.length;
        for(var i = 0; i < length; i++) {
            if (players[i].id == data.id) {
                quitter = players[i].nick;
                players.splice(i, 1);
                break;
            }
        }

        log('< Player quitted: '+ quitter +' (id: '+ data.id +').');
    });

    socket.on('newplayer', function(data) {
        var newPlayer = new Player();
        newPlayer = jQuery.extend(true, {}, data.player);
        players.push(newPlayer);

        log('> New player joined: '+ newPlayer.nick +' (id: '+ newPlayer.id +').');
        
        newPlayer = {};
    });

    socket.on('playerlist', function(data) {
        players = []; //prepare for new updated list

        var length = data.list.length;
        for(var i = 0; i < length; i++) {
            var tmpPlayer = new Player();
            tmpPlayer = jQuery.extend(true, {}, data.list[i]);
            players.push(tmpPlayer);

            tmpPlayer = {};
        }

        log('Initial player list received: '+ length +' players.');
    });

    /* Custom Events */

    socket.on('sensorData', function(sensorData) {
        log('Sensor data arrived: '+ JSON.stringify(sensorData));
        $('#map_canvas')
            .gmap('addMarker', {
                'icon': images[0],
                'tags':'evento',
                'center': new google.maps.LatLng(sensorData.loc.lon, sensorData.loc.lat),
                'bounds':true,
                'position': new google.maps.LatLng(sensorData.loc.lon, sensorData.loc.lat)
            })
            .click(function() {
                var content = '<h3>Treviso is on fire!</h3><p>Necessari 2000€</p>';
                var visibleInViewport = (
                    $('#map_canvas').gmap('inViewport', $(this)[0]) ) ? content : '';
                    $('#map_canvas').gmap('openInfoWindow', { 'content': visibleInViewport }, this);
            });

        // Update map, do stuff

    });

});