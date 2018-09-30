var map;
        var state = 0;
        var point={};
        var data={};
        
    $(document).ready(function(){
      // alert("vafvdfv");
      map = new GMaps({
        el: "#map",
        lat: 48.26,
        lng: 26.12,
        zoom: 11,
        zoomControl : true,
        zoomControlOpt: {
            style : 'SMALL',
            position: 'TOP_LEFT'
        },
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
      });

        map.addListener("click", function (e){
            if(state==0) {
                point.x = e.latLng.lng();
                point.y1 = e.latLng.lat();
                state = 1;
                return;
            }
            point.y2 = e.latLng.lat();
            console.log(point);
            $.ajax({
                method:'get',
                url:"river_points.php",
                type:"GET",
                dataType: "json",
                data:point,
                complete: function (){
                    state = 0;
                    alert("Point add!!!!");
                }
            });
        });
        
    });
        
        $(function () {
            $("#submit2").bind("click", function (e){
                console.log("its clicked");
                e.preventDefault();
                $.ajax({
                    method:'get',
                    url:"script_river.php",
                    type:"GET",
                    dataType: "json",
                    data: {
                        'day': $('#day').val()
                    },
                    success: function funcS(data){
                        console.log(data);
                        if(data.draw2.length==0){
                            alert("Такого дня в базі немає");
                            return;
                        }
                        
                        
                        map.drawPolyline({                      //нижний берег ДО
                                    path: data.draw1,               
                                    strokeColor: '#00f71c',
                                    strokeOpacity: 1,
                                    strokeWeight: 5,
                                    fillColor: '#00f71c',
                                    fillOpacity: 0
                        });
                        
                        
                        map.drawPolyline({                      //верхний берег ДО
                                    path: data.draw2,
                                    strokeColor: '#00f71c',
                                    strokeOpacity: 1,
                                    strokeWeight: 5,
                                    fillColor: '#00f71c',
                                    fillOpacity: 0
                        }); 
                        
                        map.drawPolyline({                      //нижний берег ГИС
                                    path: data.draw3,
                                    strokeColor: '#008B8B',
                                    strokeOpacity: 1,
                                    strokeWeight: 5,
                                    fillColor: '#fa0808',
                                    fillOpacity: 0
                        });
                        
                        map.drawPolyline({                      //верхний берег ГИС
                                    path: data.draw4,
                                    strokeColor: '#008B8B',
                                    strokeOpacity: 1,
                                    strokeWeight: 5,
                                    fillColor: '#fa0808',
                                    fillOpacity: 0
                        });

                        map.drawPolyline({                      //нижний берег ПОДТОПЛЕНИЕ
                                    path: data.draw5,
                                    strokeColor: '#fa0808',
                                    strokeOpacity: 1,
                                    strokeWeight: 5,
                                    fillColor: '#fa0808',
                                    fillOpacity: 0
                        });

                        map.drawPolyline({                      //верхний берег ПОДТОПЛЕНИЕ
                                    path: data.draw6,
                                    strokeColor: '#fa0808',
                                    strokeOpacity: 1,
                                    strokeWeight: 5,
                                    fillColor: '#fa0808',
                                    fillOpacity: 0
                        });

                        // var marker =
                        //         map.addMarker({
                        //           lat: data.draw1[line][0][0],
                        //           lng: data.draw1[line][0][1],
                        //         });
                        //         marker.addListener("click", function (e){
                        //             state = 1;
                        //             point.x = e.latLng.lng();
                        //
                        //         });
                    
                    }
            
                });
            });
        });
