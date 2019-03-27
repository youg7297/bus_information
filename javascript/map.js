function initMap() {
  // The location of Uluru
  var gpsX = parseFloat($(".gpsX").text()); //lng??
  var gpsY = parseFloat($(".gpsY").text()); //lat??
  if(isNaN(gpsX) || isNaN(gpsY)){ //?? ???
    gpsX = 126.988206;
    gpsY = 37.469950;
  }
  console.log(gpsX+ " " + gpsY);
  console.log(typeof(gpsX));
  var uluru = {lat: gpsY, lng: gpsX};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 15, center: uluru});
  // The marker, positioned at Uluru
  if(gpsX != 126.988206 && gpsY != 37.469950){
    var marker = new google.maps.Marker({position: uluru, map: map});
    var contentString = "<div class='stNm_m'>"+$(".stNm").text()+"</div>";
    for(var i = 0; i < $(".rtNm").length; i++){
      contentString += "　<div class='contentBus'>";
      contentString += "<div class='contentBus_box'>"
      contentString += $(".bus:eq("+i+")").html();
      contentString += "<p class='rtNm_m'>"+$(".rtNm:eq("+i+")").text()+"</p></div>";
      contentString += $(".arrmsg1:eq("+i+")").text()+"<br>";
      contentString += $(".arrmsg2:eq("+i+")").text()+"<br></div>";
    }
    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });
    
    var contentStringArr = contentString.split("　");
    $(".bus").click(function(){
      infowindow.close();
      var index =$(".bus").index(this);
      infowindow = new google.maps.InfoWindow({
        content: "<div class='stNm_m'>"+$(".stNm").text()+"</div>"+contentStringArr[index+1]
      });
      infowindow.open(map, marker);
    });
    
  }
}