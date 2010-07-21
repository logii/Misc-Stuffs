<?php
// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<script type="text/javascript"src="http://www.google.com/jsapi?key=ABQIAAAAdGcAAsfvnwqZZmeHCo-pGRQzmbhn1OKG_rWKLGQtk1XeGdSPWhRRR3LKJGlLwstlOgC8GxSP7DO1vQ"></script>
<script type="text/javascript"charset="utf-8">google.load("maps","2.x");</script>
<script type="text/javascript">
var long = "<?php print $node->field_computed[0]['value']; ?>";
var lat = "<?php print $node->field_computed[1]['value']; ?>";
<?php foreach ($rows as $id => $row):?>
  <?php print $row; ?>
<?php endforeach; ?>
$(document).ready(function() {
  // Google Map Custom Marker Maker 2010
  // Please include the following credit in your code

  // Sample custom marker code created with Google Map Custom Marker Maker
  // http://www.powerhut.co.uk/googlemaps/custom_markers.php

  var myIcon = new GIcon();
  myIcon.image = '/sites/all/themes/edos/images/icons/ep_markers/image.png';
  myIcon.shadow = '/sites/all/themes/edos/images/icons/ep_markers/shadow.png';
  myIcon.iconSize = new GSize(30,42);
  myIcon.shadowSize = new GSize(51,42);
  myIcon.iconAnchor = new GPoint(15,42);
  myIcon.infoWindowAnchor = new GPoint(15,0);
  myIcon.printImage = '/sites/all/themes/edos/images/icons/ep_markers/printImage.gif';
  myIcon.mozPrintImage = '/sites/all/themes/edos/images/icons/ep_markers/mozPrintImage.gif';
  myIcon.printShadow = '/sites/all/themes/edos/images/icons/ep_markers/printShadow.gif';
  myIcon.transparent = '/sites/all/themes/edos/images/icons/ep_markers/transparent.png';
  myIcon.imageMap = [19,0,21,1,23,2,24,3,25,4,26,5,26,6,27,7,27,8,28,9,28,10,28,11,29,12,29,13,29,14,29,15,28,16,28,17,28,18,27,19,27,20,26,21,25,22,25,23,24,24,24,25,23,26,22,27,22,28,21,29,20,30,20,31,19,32,19,33,18,34,18,35,17,36,17,37,16,38,16,39,15,40,15,41,14,41,14,40,14,39,13,38,13,37,12,36,12,35,11,34,11,33,10,32,10,31,9,30,8,29,8,28,7,27,6,26,5,25,5,24,4,23,4,22,3,21,2,20,2,19,1,18,1,17,1,16,1,15,0,14,0,13,1,12,1,11,1,10,1,9,2,8,2,7,3,6,3,5,4,4,5,3,6,2,8,1,10,0];
  
  var map = new GMap2(document.getElementById('map')); 
  var defaultCentre = new GLatLng(1.35188,103.821487); 
  map.setCenter(defaultCentre, 10); 
  map.addControl(new GSmallMapControl());
  
  var latlng = [
  <?php foreach ($rows as $id => $row):?>
    <?php print $row; ?>
  <?php endforeach; ?>
  ];
  var markers = []; 
  for ( var i = 0; i < latlng.length; i++ )
    {
      var marker = new GMarker( latlng[ i ], myIcon );
      map.addOverlay( marker );
      markers[i] = marker;
    }
    $(markers).each(function(i,marker){ 
      GEvent.addListener(marker,"click", function(){ 
        map.panTo(marker.getLatLng()); 
      });
      $("<li />") 
        .html("Point"+i) 
        .click(function(){ 
          map.panTo(marker.getLatLng()); 
        }) 
        .appendTo("#list");
    });

});

</script>

<div id="map" style="width:310px; height:210px;"></div>
<ul id="list"></ul>