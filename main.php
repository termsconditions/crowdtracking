<?php 
    session_start();
    include "dbcon.php";
    
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
    <style type="text/css">
        .muncul
        {
            display: none;
        }
        .foo {
            position: fixed;
            bottom: 20px;
            right: 0;
            z-index: 2;
            background: gray;
            height: 300px;
            width: 270px;
            overflow: auto;
            padding: 10px 10px;
          }
    </style>
  </head>
  <body>
    <div id="map" style="width: 100%; height: 100%;margin:0px;position:absolute;"> </div>
    
    <div id="aa"  class="muncul" style="float:right;width:500px;height:100%;background:yellow;position:absolute;">
        <div style="margin-top:70px;">
            <ul id="menus">
            </ul>
        </div>
        <div id="someOneConts"></div>
    </div>

    <script type="text/javascript">
    //getChat
        function getComment()
        {
            var comment;
            var qurl = "getData.php";
            var user2 = $("#ids").val();
            var dtkirim = {"req":'3',"ids":user2};
            $.ajax({
                url: qurl,
                data: dtkirim,
                async: false,
                type: "POST",
                crossDomain: true,
                dataType: "text",
                success: function (resp)
                {
                    //data = JSON.parse(resp);
                    //alert(resp);
                   $("#blokComment").html(resp);
                }
            });    
        }
        
    
    
    

    </script>
    <div id="bb" class="foo muncul">
        <div id="blokComment"></div>
        <div id="formGan" style="bottom:20px;position:fixed;">
            <form id="formChat" method="post" name="fChat">
                <input id="ids" type="hidden" name="ids" value='' readonly='yes'>
                <input style="width:77%;"name="isi" type="text" required autofocus>
                <button id="subChat" type="submit">send</button>
            </form>
        </div>
        <script type="text/javascript">
            //submit chat
                var form = $('#formChat');
                var submit = $('#subChat');

                form.on('submit', function(e){
                    e.preventDefault();
                    $.ajax({
                        url : 'chat.php',
                        type : 'POST',
                        cache : false,
                        data : form.serialize(),
                        /*beforeSend: function(){
                            submit.val('Sedang Menambahkan...').attr('disabled', 'disabled');
                        },*/
                        success: function(data){
                            // Append with fadeIn see http://stackoverflow.com/a/978731
                           // alert(data);
                            var item = $(data).hide().fadeIn(800);
                            $('#blokComment').append(item);

                            // reset form and button
                            form.trigger('reset');
                           // submit.val('Tambahkan').removeAttr('disabled');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                          console.log(textStatus, errorThrown);
                        }

                    });
                });
                  
        </script>
    </div>

    <script type="text/javascript">

                var myLat;
                var myLng;
                L.mapbox.accessToken = 'pk.eyJ1IjoicmlmcWl0aG9taSIsImEiOiJpUjFieHdVIn0.Cz3ME0XeH01-5IRnCJl3SA';
                var map = L.mapbox.map('map', 'rifqithomi.jb5ibjeg')
                    .setView([-1.527, 118.215], 5);
                    
                var myLayer = L.mapbox.featureLayer().addTo(map);
                myLayer.on('layeradd', function(e) {

                    var marker = e.layer,
                        feature = marker.feature;

                    // Create custom popup content
                    var popupContent =  e.layer.feature.properties.status;

                    // http://leafletjs.com/reference.html#popup
                    marker.setIcon(L.icon(feature.properties.icon));
                    marker.bindPopup(popupContent,{
                        closeButton: false,
                        maxWidth: 300
                    });
                    e.layer.feature.geometry.coordinates.reverse();
                });

                    map.locate();
                    var throwLocate = setInterval(function(){map.locate();},3000);

                    map.on('locationfound', function(e){
                        var myLat = e.latlng.lat;
                        var myLng = e.latlng.lng;
                        var me = reqData('1');
                        var datas = me.concat(reqData('2'));

                        myLayer.setGeoJSON(datas);
                        var throwUpdate = setInterval(function(){
                            update(myLat,myLng,"<?php echo $_SESSION['id_tab_user'];?>")
                        },4000);

                        var throwData = setInterval(function(){
                            var me = reqData('1');
                            var datas = me.concat(reqData('2'));
                            myLayer.setGeoJSON(datas);
                        },6000);;
                        
                    });
                    map.on('locationerror', function() {
                        alert('Posisi Anda Tidak Dapat Ditemukan');
                    });

                    //event
                    myLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });
                    myLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });
                    myLayer.on('click',function(e){

                        $("#menus").html('');
                        $("#someOneConts").html('');
                        $("#menus").append('<li><a id="profile" style="margin-right:5px;" href="#">Profile</a></li>');
                        $("#menus").append('<li><a id="chat" style="margin-right:9px;" href="#">Chat</a></li>');
                        $("#someOneConts").append("Status: "+e.layer.feature.properties.status+"</br>");
                        $("#someOneConts").append("Nama: "+e.layer.feature.properties.nama);


                        $("ul li #profile").click(function(){
                            $("#someOneConts").html('');
                            $("#someOneConts").append("Status: "+e.layer.feature.properties.status+"</br>");
                            $("#someOneConts").append("Nama: "+e.layer.feature.properties.nama);
                        });
                        $("ul li #chat").click(function(){
                            $("#bb").removeClass("muncul");
                            $("#ids").val(e.layer.feature.id);
                            getComment();
                            //$("#someOneConts").html('');
                            //$("#someOneConts").html("<div id ='blokComment' style='padding:2px 2px;margin-bottom:30px;height:auto;'></div><form id='chatss' method='post'><input style='height:35px;margin-bottom:10px;width:700px;float:left;' name='isi' id='isi' type='text' class='form-control' placeholder='' required><input name ='ids' type='hidden' class='form-control'  value='"+e.layer.feature.id+"' readonly='yes'><button id='subchat' style='height:35px;line-height: 10px;float:right;width:150px;margin-right:20px' class='btn btn-lg btn-primary btn-block' type='button'>Kirim</button></form>");
                           
                        });
                        $("#subchat").click(function(){
                            Kirim('c');
                        });

                        $('#nameOrang').html(e.layer.feature.properties.nama);
                        $("#bb").addClass("muncul");
                        $("#aa").removeClass("muncul");
                        $("#aa").bind('click',function(){
                          $(this).addClass("muncul");
                        });
                       // $('#myModal').modal('show'); 
                        map.setView( e.layer.feature.geometry.coordinates,12);  

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
                           }

                        });                        
                    }

                    function getChat()
                    {

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
                                       
                                      }
                                });
                        return data;
                        
                    }
                   
    </script>
  </body>
  </html>

