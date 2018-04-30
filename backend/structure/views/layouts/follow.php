
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Follow (AFAQYAVL)</title>

        <link type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/theme/jquery-ui.css?v=<?php echo Yii::app()->params['v'] ?>" rel="Stylesheet" />
        <link type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/theme/ui.jqgrid.css?v=<?php echo Yii::app()->params['v'] ?>" rel="Stylesheet" />
        <link type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/theme/style.css?v=<?php echo Yii::app()->params['v'] ?>" rel="Stylesheet" />

        <link type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/theme/leaflet/leaflet.css?v=<?php echo Yii::app()->params['v'] ?>" rel="Stylesheet" />
        <link type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/theme/leaflet/leaflet.label.css?v=<?php echo Yii::app()->params['v'] ?>" rel="Stylesheet" />

        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/leaflet/leaflet.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/leaflet/tile/google.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/leaflet/tile/bing.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/leaflet/tile/yandex.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/leaflet/leaflet.label.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/leaflet/marker.rotate.js?v=<?php echo Yii::app()->params['v'] ?>"></script>




        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/jquery-2.1.1.min.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/jquery-migrate-1.2.1.min.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/jquery.jqGrid.locale.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/jquery.jqGrid.min.js?v=<?php echo Yii::app()->params['v'] ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js-src/AymaXJS_language.<?php echo Yii::t('app', 'DIR') ?>.js?v=233"></script>


        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/moment.min.js?v=233"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/aymax.config.js?v=233"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/js/aymax.common.js?v=233"></script>

        <script>


            var pathname = '<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/';
            var basepathname = '<?php echo Yii::app()->request->baseUrl ?>/';
            var NODEURL = '<?php echo Yii::app()->params['nodeurl'] ?>';
            var realbase = '<?php echo Yii::app()->getBaseUrl(true); ?>';
            var DIR = '<?php echo Yii::t('app', 'DIR'); ?>';
            var DIRS = '<?php echo Yii::t('app', 'Left'); ?>';
            var DIRS2 = '<?php echo Yii::t('app', 'Right'); ?>';


        </script>

        <script>
            // vars
            var la = [];
            var map;
            var mapLayers = new Array();
            var mapPopup;
            var timer_followObject;
            var objectsData = new Array();
            var objectsDataX = new Array();
            objectsDataX.layers = new Array();


            var pathname = '<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/';
            var basepathname = '<?php echo Yii::app()->request->baseUrl ?>/';




            var settingsValuesUser = new Array();
            var settingsValuesObjects = new Array();

            // icons
            var mapMarkerIcons = new Array();

            mapMarkerIcons['arrow_red'] = L.icon({
                iconUrl: pathname + '/img/markers/arrow_red.png',
                iconSize: [16, 24], // size of the icon
                iconAnchor: [8, 12], // point of the icon which will correspond to marker's location
                popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
            });

            mapMarkerIcons['arrow_green'] = L.icon({
                iconUrl: pathname + '/img/markers/arrow_green.png',
                iconSize: [16, 24], // size of the icon
                iconAnchor: [8, 12], // point of the icon which will correspond to marker's location
                popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
            });

            $.ajax({
                type: "POST",
                url: pathname + "/img/markers/objects/list.php",
                data: {},
                dataType: 'json',
                success: function (result)
                {
                    for (i = 0; i < result.length; i++)
                    {
                        mapMarkerIcons[result[i]] = L.icon({
                            iconUrl: pathname + 'img/markers/objects/' + result[i],
                            iconSize: [26, 26], // size of the icon
                            iconAnchor: [13, 13], // point of the icon which will correspond to marker's location
                            popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
                        });
                    }
                }
            });

            function load()
            {

                settingsLoad('user');

                initGrids();
                initGui();

                map = L.map('map_follow', {minZoom: 3, maxZoom: 18, editable: true});

                // add map types
                initSelectList('map_type_list');

                // define map layers
                if (gsValues['map_osm'])
                {
                    mapLayers['osm'] = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                }

                if (gsValues['map_google'])
                {
                    mapLayers['gmap'] = new L.Google('ROADMAP');
                    mapLayers['gsat'] = new L.Google('SATELLITE');
                    mapLayers['ghyb'] = new L.Google('HYBRID');
                }

                if (gsValues['map_bing'])
                {
                    mapLayers['broad'] = new L.BingLayer(gsValues['map_bing_api'], {type: 'Road'});
                    mapLayers['baer'] = new L.BingLayer(gsValues['map_bing_api'], {type: 'Aerial'});
                    mapLayers['bhyb'] = new L.BingLayer(gsValues['map_bing_api'], {type: 'AerialWithLabels'});
                }

                if (gsValues['map_yandex'])
                {
                    mapLayers['yandex'] = new L.Yandex();
                }

                // define layers	
                mapLayers['realtime'] = L.layerGroup();
                mapLayers['realtime'].addTo(map);

                // set map type
                var map_type = 1;
                document.getElementById("map_type").value = map_type;
                ThisswitchMapType(map_type);

                map.setView([0, 0], 15);

                followObject(<?php echo Yii::app()->request->getParam('imei') ?>);

                var load2 = setTimeout("load2()", 2000);
            }

            function load2()
            {
                document.getElementById("loading_panel").style.display = "none";
            }

            function unload()
            {

            }

            function followObject(imei)
            {
                clearTimeout(timer_followObject);

                var data = {
                    imei: imei
                };

                $.ajax({
                    type: "POST",
                    url: basepathname + "index.php?r=AymaXData_Vehicle&type=FollowUpdate",
                    data: data,
                    dataType: 'json',
                    cache: false,
                    error: function (statusCode, errorThrown) {
                        // shedule next object reload
                        timer_followObject = setTimeout("followObject('" + imei + "');", gsValues['map_refresh'] * 1000);
                    },
                    success: function (result)
                    {
                        objectsData = result;



                        removeObjectFromMap();
                        addObjectToMap(imei);


                        if (document.getElementById("follow").checked == true)
                        {

                            map.panTo({lat: result.Y, lng: result.X});
                        }

                        // shedule next object reload
                        timer_followObject = setTimeout("followObject('" + imei + "');", gsValues['map_refresh'] * 1000);
                    }
                });
            }

            function addObjectToMap(imei)
            {
                // get data
                var name = objectsData['n'];

                if (objectsData['Y'] != '')
                {
                    var lat = objectsData['Y'];
                    var lng = objectsData['X'];
                    var altitude = objectsData['Altitude'];
                    var angle = objectsData['VectorAngle'];
                    var speed = objectsData['VectorSpeed'];
                    var dt_tracker = objectsData['GpsTime'];

                    var extra_data = objectsData;
                    showExtraData(imei, extra_data);
                }
                else
                {
                    var lat = 0;
                    var lng = 0;
                    var speed = 0;
                }

                // rotate marker only if icon is arrow
                var iconAngle = angle;
                if (settingsValuesUser['map_icon'] != 'arrow')
                {
                    iconAngle = 0;
                }

                var icon = getMarkerIcon(speed, imei);
                var marker = L.marker([lat, lng], {icon: icon, iconAngle: iconAngle});

                // put label near marker
                var label_text = name + " (" + speed + " " + settingsValuesUser['unit_speed_string'] + ")";
                marker.bindLabel(label_text, {noHide: true, offset: [20, -12], direction: 'right'});

                // set click event
                marker.on('click', function (e) {
                    if (objectsData['Y'] != '')
                    {
                        geocoderGetAddress(lat, lng, function (responce)
                        {
                            var address = responce;
                            var position = urlPosition(lat, lng);

                            var text = '<table>\
                                                        <tr><td><strong>' + la['OBJECT'] + ':</strong></td><td><strong>' + name + '</strong></td></tr>\
                                                        <tr><td><strong>' + la['ADDRESS'] + ':</strong></td><td>' + address + '</td></tr>\
                                                        <tr><td><strong>' + la['POSITION'] + ':</strong></td><td>' + position + '</td></tr>\
                                                        <tr><td><strong>' + la['ALTITUDE'] + ':</strong></td>\
                                                        <td>' + altitude + ' ' + settingsValuesUser['unit_height_string'] + '</td></tr>\
                                                        <tr><td><strong>' + la['ANGLE'] + ':</strong></td><td>' + angle + ' &deg;</td></tr>\
                                                        <tr><td><strong>' + la['SPEED'] + ':</strong></td>\
                                                        <td>' + speed + ' ' + settingsValuesUser['unit_speed_string'] + '</td></tr>\
                                                        <tr><td><strong>' + la['TIME'] + ':</strong></td><td>' + dt_tracker + '</td></tr>\
                                                        </table>';

                            addPopupToMap(lat, lng, [0, -12], text);
                        });
                    }
                });

                marker.on('add', function (e) {
                    addObjectTailToMap(imei);
                });

                marker.on('remove', function (e) {
                    if (objectsDataX.layers.tail)
                    {
                        mapLayers['realtime'].removeLayer(objectsDataX.layers.tail);
                    }
                });

                mapLayers['realtime'].addLayer(marker);

                // store layer
                objectsDataX.layers.marker = marker;
            }

            function removeObjectFromMap()
            {
                mapLayers['realtime'].clearLayers();
            }

            function addObjectTailToMap(imei)
            {

                if (objectsDataX.layers.tail)
                {
                    mapLayers['realtime'].removeLayer(objectsDataX.layers.tail);
                }

                if (objectsData['tail'] != '-1') {

                    var line_points = new Array();

                    var d;
                    var path = objectsData['tail'].split(';');
                    var pathcount = path.length;
                    if (pathcount > 0) {

                        for (d = 0; d < pathcount; d++) {
                            var cord = path[d].split(',');

                            var f = cord[1];
                            var c = cord[0];

                            line_points.push(L.latLng(parseFloat(f), parseFloat(c)));
                        }
                    }



                    var i;



                    // draw tail polyline
                    var tail = L.polyline(line_points, {color: settingsValuesUser['map_tc'], opacity: 0.8, weight: 3});

                    mapLayers['realtime'].addLayer(tail);

                    // store layer
                    objectsDataX.layers.tail = tail;
                }

            }

            function showExtraData(imei, data)
            {
                var list_id = $("#left_panel_follow_data_list_grid");
                var list_data = [];

                list_id.clearGridData(true);

                // exit function if no object data
                if (data == '')
                    return;



                var lat = data['Y'];
                var lng = data['X'];
                var altitude = data['Altitude'];
                var angle = data['VectorAngle'];
                var speed = data['VectorSpeed'];
                var dt_tracker = data['GpsTime'];
                var dt_server = data['TimeStamp'];

                list_data.push({data: la['ODOMETER'] + ':', value: data['odometer'] + ' ' + settingsValuesUser['unit_distance_string']});

                list_data.push({data: la['ENGINE_HOURS'] + ':', value: data['engine_hours'] + ' h'});

                list_data.push({data: la['TIME_POSITION'] + ':', value: dt_tracker});
                list_data.push({data: la['TIME_SERVER'] + ':', value: dt_server});

                var model = data['mo']; // get model
                if (model != "")
                {
                    list_data.push({data: la['MODEL'] + ':', value: model});
                }

                var vin = data['vin']; // get VIN
                if (vin != "")
                {
                    list_data.push({data: 'VIN:', value: vin});
                }

                var plate_number = data['pn']; // get plate_number
                if (plate_number != "")
                {
                    list_data.push({data: la['PLATE'] + ':', value: plate_number});
                }



                //var driver_id = settingsValuesObjects[imei]['driver_id']; // get driver_id

                //// check for ibutton/rfid
                //if (driver_id == 0)
                //{
                //	var ibut = getSensorParamValue(data['params'], 'ibut');
                //	var rfid = getSensorParamValue(data['params'], 'rfid');
                //	
                //	if (ibut != 0)
                //	{
                //	      driver_id = getDriverFromIbutRFID(ibut); // get driver_id from ibutton/rfid
                //	}
                //	else
                //	{
                //	      driver_id = getDriverFromIbutRFID(rfid); // get driver_id from ibutton/rfid                                     
                //	}
                //}

                //if (driver_id > 0)
                //{
                //	if (settingsValuesObjectDrivers[driver_id])
                //	{
                //		var driver_name = '<a href="#" onclick="utilsShowDriverInfo(\''+driver_id+'\');">' + settingsValuesObjectDrivers[driver_id]['name'] + '</a>'; // get driver name
                //		list_data.push({data: la['DRIVER']+':', value: driver_name});
                //	}
                //}

                //// get address
                //if (gsValues['left_panel_address'] == true)
                //{
                //	geocoderGetAddress(lat, lng, function(responce)
                //	{
                //		document.getElementById("left_panel_objects_object_data_list_grid_address").innerHTML = responce;
                //		objectsDataX['address'] = responce;
                //	});
                //
                //	var address = '<div id="left_panel_objects_object_data_list_grid_address">'+objectsDataX['address']+'</div>';
                //	list_data.push({data: la['ADDRESS']+':', value: address});
                //}

                var position = urlPosition(lat, lng);

                list_data.push({data: la['POSITION'] + ':', value: position});
                list_data.push({data: la['SPEED'] + ':', value: speed + ' ' + settingsValuesUser['unit_speed_string']});
                list_data.push({data: la['ALTITUDE'] + ':', value: altitude + ' ' + settingsValuesUser['unit_height_string']});
                list_data.push({data: la['ANGLE'] + ':', value: angle + ' &deg;'});

                //// get nearest zone and marker
                //var nearest_zone = getNearestZone(imei, lat, lng);
                //if (nearest_zone['name'] != '')
                //{
                //       list_data.push({data: la['NEAREST_ZONE']+':', value: nearest_zone['name'] + ' (' + nearest_zone['distance'] + ')'});
                //}
                //
                //var nearest_marker = getNearestMarker(imei, lat, lng);
                //if (nearest_marker['name'] != '')
                //{
                //    list_data.push({data: la['NEAREST_MARKER']+':', value: nearest_marker['name'] + ' (' + nearest_marker['distance'] + ')'});
                //}

                // add sensors to object data list
                /*
                 var sensors = settingsValuesObjects[imei]['sensors'];
                 for (var key in sensors)
                 {
                 var sensor = sensors[key];
                 var sensor_data = getSensorValue(data['params'], sensor);
                 list_data.push({data: sensor.name + ':', value: sensor_data.value_full});
                 }
                 */

                for (var i = 0; i < list_data.length; i++)
                {
                    list_id.jqGrid('addRowData', i, list_data[i]);
                }
                list_id.setGridParam({sortname: 'data', sortorder: 'asc'}).trigger('reloadGrid');
            }

            function showhideInfo()
            {
                var map_left = "280px";

                if ($(window).width() < 640)
                {
                    var map_left = "0px";
                }

                if (document.getElementById("info").checked == true) {
                    document.getElementById("left_panel_follow").style.display = "block";
                    document.getElementById("map_follow").style.left = map_left;

                    setTimeout(function () {
                        map.invalidateSize(true);
                    }, 200);
                } else {
                    document.getElementById("left_panel_follow").style.display = "none";
                    document.getElementById("map_follow").style.left = "0px";

                    setTimeout(function () {
                        map.invalidateSize(true);
                    }, 200);
                }
            }

            function initGui()
            {
                $(window).bind('resize', function ()
                {
                    showhideInfo();
                }).trigger('resize');
            }

            function initGrids()
            {
                // define left panel object data list grid
                $("#left_panel_follow_data_list_grid").jqGrid({
                    datatype: 'local',
                    colNames: [la['DATA'], la['VALUE']],
                    colModel: [
                        {name: 'data', index: 'data', width: 90, sortable: false},
                        {name: 'value', index: 'value', width: 163, sortable: false}
                    ],
                    width: '280',
                    height: '100',
                    rowNum: 100,
                    shrinkToFit: false
                });

                $(window).bind('resize', function ()
                {
                    if ($(window).width() < 640)
                    {
                        $("#left_panel_follow_data_list_grid").setGridHeight($(window).height() - 105);
                    }
                    else
                    {
                        $("#left_panel_follow_data_list_grid").setGridHeight($(window).height() - 30);
                    }
                }).trigger('resize');
            }

            function initSelectList(list)
            {
                switch (list)
                {
                    case "map_type_list":
                        var select = document.getElementById('map_type');
                        select.options.length = 0; // clear out existing items

                        if (gsValues['map_osm'])
                        {
                            select.options.add(new Option('OSM Map', '1'));
                        }

                        if (gsValues['map_google'])
                        {
                            select.options.add(new Option('Google Streets', '2'));
                            select.options.add(new Option('Google Satellite', '3'));
                            select.options.add(new Option('Google Hybrid', '4'));
                        }

                        if (gsValues['map_bing'])
                        {
                            select.options.add(new Option('Bing Road', '5'));
                            select.options.add(new Option('Bing Aerial', '6'));
                            select.options.add(new Option('Bing Hybrid', '7'));
                        }

                        if (gsValues['map_yandex'])
                        {
                            select.options.add(new Option('Yandex', '8'));
                        }
                        break;
                }
            }

            function addPopupToMap(lat, lng, offset, text)
            {
                mapPopup = L.popup({offset: offset}).setLatLng([lat, lng]).setContent(text).openOn(map);
            }

            function settingsLoad(type)
            {
                switch (type)
                {
                    case "user":
                        var data = {};
                        $.ajax({
                            type: "POST",
                            url: basepathname + "index.php?r=AymaXData&type=User",
                            data: data,
                            dataType: 'json',
                            cache: false,
                            async: false,
                            success: function (result)
                            {
                                settingsValuesUser = result;
                            }
                        });
                        break;

                }
            }



            function ThisswitchMapType(id)
            {
                id = parseInt(id);
                gsValues.map_layer = id;
                var map_settings = {};
                //console.log("gsValues---- ",gsValues);
                if (gsValues['map_osm'])
                {
                    map.removeLayer(mapLayers['osm']);
                }

                if (gsValues['map_google'])
                {
                    map.removeLayer(mapLayers['gmap']);
                    map.removeLayer(mapLayers['gsat']);
                    map.removeLayer(mapLayers['ghyb']);
                }

                if (gsValues['map_bing'])
                {
                    map.removeLayer(mapLayers['broad']);
                    map.removeLayer(mapLayers['baer']);
                    map.removeLayer(mapLayers['bhyb']);
                }

                if (gsValues['map_yandex'])
                {
                    map.removeLayer(mapLayers['yandex']);
                }


                switch (id)
                {
                    case 1:
                        map.addLayer(mapLayers['osm']);
                        map_settings = {name: "map_settings", value: {active_one: 1}};
                        var map_type = "OSM Map";
                        break;
                    case 2:
                        map.addLayer(mapLayers['gmap']);
                        map_settings = {name: "map_settings", value: {active_one: 2}};
                        var map_type = "Google Streets";
                        break;
                    case 3:
                        map.addLayer(mapLayers['gsat']);
                        map_settings = {name: "map_settings", value: {active_one: 3}};
                        var map_type = "Google Satellite";
                        break;
                    case 4:
                        map.addLayer(mapLayers['ghyb']);
                        map_settings = {name: "map_settings", value: {active_one: 4}};
                        var map_type = "Google Hybrid";
                        break;
                    case 5:
                        map.addLayer(mapLayers['broad']);
                        map_settings = {name: "map_settings", value: {active_one: 5}};
                        break;
                    case 6:
                        map.addLayer(mapLayers['baer']);
                        map_settings = {name: "map_settings", value: {active_one: 6}};
                        break;
                    case 7:
                        map.addLayer(mapLayers['bhyb']);
                        map_settings = {name: "map_settings", value: {active_one: 7}};
                        break;
                    case 8:
                        map.addLayer(mapLayers['yandex']);
                        map_settings = {name: "map_settings", value: {active_one: 8}};
                        break;
                }


            }


        </script>
    </head>



    <body onload="load()" onUnload="unload()">
        <div id="loading_panel">
            <div class="table">
                <div class="table-cell center-middle">
                    <div class="loader"><img style="border:0px" src="AymaXTrack/img/loading.gif" /><span></span>
                    </div>
                </div>
            </div>
        </div>

        <div id="map_follow"></div>
        <div class="object-follow-control">
            <input id="info" type="checkbox" class="checkbox" onclick="showhideInfo();"/>&nbsp;Info		<input id="follow" type="checkbox" class="checkbox" checked/>&nbsp;Follow		&nbsp;<select id="map_type" onChange="ThisswitchMapType($(this).val());"></select>
        </div>
        <div id="left_panel_follow">
            <div id="left_panel_follow_data_list">
                <table id="left_panel_follow_data_list_grid"></table>
            </div>
        </div>
        <?php echo $content; ?>

    </body>
</html>

