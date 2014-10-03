<?php 
    session_start();
    include "dbcon.php";
    $_SESSION['id']=2;
    $idUser = 2;
    $qrUser = "SELECT * from user where id_tab_user = ".$idUser." ";
    $getUser = mysql_query($qrUser);
    $resultUser=mysql_fetch_array($getUser);
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Crowd Tracker</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox.js/v2.0.1/mapbox.js'></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href='https://api.tiles.mapbox.com/mapbox.js/v2.0.1/mapbox.css' rel='stylesheet' />
  </head>
  <body>
    <div id="map" style="width: 100%;z-index:1; height: 100%;margin:0px;position:absolute;"></div>
    <div style="float:right;width:50px;height:150px;z-index:2;background:red;position:absolute;">
        <span style="">hover</span>
    </div>
    <script type="text/javascript">

                var myLat;
                var myLng;
                

                //var follower = me.concat(reqData('<?php echo  $idUser;?>'));

                L.mapbox.accessToken = 'pk.eyJ1IjoicmlmcWl0aG9taSIsImEiOiJpUjFieHdVIn0.Cz3ME0XeH01-5IRnCJl3SA';
                var map = L.mapbox.map('map', 'rifqithomi.jb5ibjeg')
                    .setView([-1.527, 118.215], 5);
                    
                var myLayer = L.mapbox.featureLayer().addTo(map);
                myLayer.on('layeradd', function(e) {
                    var marker = e.layer,
                        feature = marker.feature;

                    // Create custom popup content
                    var popupContent =  e.layer.feature.properties.nama;

                    // http://leafletjs.com/reference.html#popup
                    marker.setIcon(L.icon(feature.properties.icon));
                    marker.bindPopup(popupContent,{
                        closeButton: false,
                        maxWidth: 300
                    });
                    e.layer.feature.geometry.coordinates.reverse();
                });

                    
                    
                    


                    map.locate();
                    var k = setInterval(function(){map.locate();},3000);
                    
                    map.on('locationfound', function(e){
                        var myLat = e.latlng.lat;
                        var myLng = e.latlng.lng;
                        var idUser = "<?php echo $idUser;?>";
                        var me = reqData('1');
                        var datas = me.concat(reqData('2'));
                        
                        myLayer.setGeoJSON(datas);
                        //var t = setInterval(function(){update(myLat,myLng,idUser)},4000);
                        /*var l = setInterval(function(){
                                                        myLat = myLat - 0.2;
                                                        myLng = myLng + 0.3;
                                                        me.geometry.coordinates[1] = myLat;
                                                        me.geometry.coordinates[0] = myLng;
                                                    },5000);*/
                        /*var p = setInterval(function(){
                                                        myLayer.setGeoJSON(datas);
                                                         console.log(datas);
                                                        },5000);*/

                    });
                    map.on('locationerror', function() {
                        alert('Posisi Anda Tidak Dapat Ditemukan');
                    });



                    //update my location
                    function update(lat,lng,id)
                    {
                        $.ajax({
                            url : 'update.php',
                            type : 'POST',
                            cache : false,
                            data : {"lat":lat,"lng":lng,"idUser":id},
                           /* beforeSend: function(){
                                submit.val('Sedang Check In...').attr('disabled', 'disabled');
                            },*/
                            success: function(data){
                                var s = JSON.parse(data);   
                                myLat = s.lat;
                                myLng = s.ln;
                                //console.log(myLat+' '+myLng);
                           }

                        });                        
                    }


                    //request data
                    function reqData(req){
                        var data;
                        var qurl = "getData.php";
                        var dtkirim = {"req":req};
                        $.ajax({
                                    url: qurl,
                                    data: dtkirim,
                                    async: false,
                                    type: "POST",
                                    crossDomain: true,
                                    dataType: "text",
                                    success: function (resp)
                                      {
                                       data = JSON.parse(resp);
                                       console.log(data);
                                      }
                                });
                        return data;
                        
                    }
                    
                   
    </script>
  </body>
  </html>
