<style type="text/css">
	
</style><script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script type="text/javascript">
function initialize() {
  var myLatlng = new google.maps.LatLng(37.754420, 127.075776);
  var mapOptions = {
    zoom: 15,
	scrollwheel: false,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
	  animation: google.maps.Animation.DROP,
      title: 'Dodoom'
  });
  
  var contentString = '<div class="info-window-content"><h2>Web Pixels</h2>'+
  					  '<h3>Designing forward</h3>'+
					  '<p>Some more details for directions or company informations...</p></div>';
					  
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
  
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>

	<div class="pg-opt pin">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>약도</h2>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="/ara/">Home</a></li>
                        <li class="active">약도</li>
                    </ol>
                </div>
                
            </div>
        </div>
    </div>
<section class="slice no-padding">
	<div id="mapCanvas" class="map-canvas no-margin"></div>
</section>
<section class="slice bg-3 animate-hover-slide">
	<div class="w-section inverse blog-grid">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="section-title">회사 정보</h3>
					<h5>경기도 의정부시 호국로 1574-9 (금오동 476-11)</h5> 
					
					<h5>대표전화 : (031)856-3041 / FAX:(031)856-3042 / Email : araenc@naver.com</h5>					

					
				</div>
				
			</div>
		</div>
	</div>
</section>
