<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ActiveQuery;
use yii\data\ActiveDataProvider;
use frontend\modules\pcc\models\Person;
use frontend\modules\pcc\models\Gis;
use yii\helpers\Json;

$this->registerCssFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.css', ['async' => false, 'defer' => true]);
$this->registerJsFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.js', ['position' => $this::POS_HEAD]);
$this->registerCssFile('../lib-gis/leaflet-search.min.css', ['async' => false, 'defer' => true]);
$this->registerCssFile('../lib-gis/leaflet.label.css', ['async' => false, 'defer' => true]);
$this->registerJsFile('../lib-gis/leaflet-search.min.js', ['position' => $this::POS_HEAD]);
$this->registerJsFile('../lib-gis/leaflet.label.js', ['position' => $this::POS_HEAD]);
?>
<ul>
    <li class="btn btn-info"><?=Html::a('ไปหน้า Test', ['test/index'])?></li>
    <li class="btn btn-info"><?=Html::a('ไปหน้า Test2 ด้วย ID', ['test/test2','id'=>'1'])?></li>
    <li class="btn btn-info">MENU3</li>
    <li class="btn btn-info">MENU4</li>

</ul>
<div id="map" style="width: 100%;height: 75vh;">
</div>
<?php
$model = Person::find()->asArray()->all();
$person_point =[];
foreach($model as $value){
  $person_point[] = [
    'type'  =>'Feature',
    'properties'  =>[
          'PNAME'  => $value['prename'],
          'NAME'  =>  $value['name'],
          'LNAME' =>  $value['lname'],
          'RAPID' =>  $value['rapid'],
          'SEARCH_TEXT' =>$value['prename']." ".$value['name']." ".$value['lname'],
      ],
    'geometry'=>[
          'type'=>'Point',
          'coordinates'=>[$value['lon']*1,$value['lat']],
            ]
      ];

}


$person_point = json_encode($person_point);

$model = Gis::find()->asArray()->all();
$tumbon_pol = [];
foreach($model as $value){
  $tumbon_pol[] = [
    'type'  =>'Feature',
    'properties'  =>[
          'PROV_CODE'  => $value['PROV_CODE'],
          'AMP_CODE'  =>  $value['AMP_CODE'],
          'TAM_CODE' =>  $value['TAM_CODE'],
          'TAM_NAMT' =>  $value['TAM_NAMT']
          ],
    'geometry'=>[
          'type'=>'MultiPolygon',
          'coordinates'=>json_decode($value['COORDINATES']),
            ]
      ];
}
$tumbon_pol = json_encode($tumbon_pol);
//print_r($person_point);
$js=<<<JS
L.mapbox.accessToken = 'pk.eyJ1IjoiZ29sZGVyYm95IiwiYSI6ImNqMzJnd29mNDAwMXAycW5yM21xcXNpNWsifQ.dYO7mu3w1gQJOQLbVXDrzg';
var map = L.mapbox.map('map', 'mapbox.streets').setView([18.064,97.846], 9);
//base Layer
    var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });
    var googleStreet = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var baseLayers = {
    	      "OSM ภูมิประเทศ": L.mapbox.tileLayer('mapbox.streets'),
            "OSM ถนน":L.tileLayer('//{s}.tile.osm.org/{z}/{x}/{y}.png'),
            "OSM ดาวเทียม": L.mapbox.tileLayer('mapbox.satellite'),
            "OSM Terrain":googleTerrain,
            "Google Hybrid":googleHybrid,
            "Google Street":googleStreet.addTo(map)
     };
//base Layer



//Drag Maker
  var marker = L.marker(new L.LatLng(18.064,97.846), {
      draggable: true
  });

  marker.addTo(map);
  marker.on("dragend",function(e){
      var pos = e.target.getLatLng();
      this.bindPopup(pos.toString()).openPopup();
  });
//Drag Maker

//สร้างกลุ่ม
var _group1   = L.layerGroup().addTo(map);
var _group2   = L.layerGroup();
var ic_green  = L.mapbox.marker.icon({'marker-color': '31A105'});
var ic_red    = L.mapbox.marker.icon({'marker-color': 'E30303'});
var ic_yellow = L.mapbox.marker.icon({'marker-color': 'FFFF00'});
var ic_white  = L.mapbox.marker.icon({'marker-color': 'FFFFFF'});
//โหลดพิกัด

  var home = L.geoJson($person_point,{
                onEachFeature:function(feature,layer){
                  layer.bindPopup(
                        feature.properties.PNAME+' '
                        +feature.properties.NAME+' '
                        +feature.properties.LNAME
                      );
                  switch(feature.properties.RAPID){
                    case 'Red':
                          layer.setIcon(ic_red);
                        break;
                    case 'Green':
                          layer.setIcon(ic_green);
                        break;
                    case 'Yellow':
                          layer.setIcon(ic_yellow);
                        break;
                    default :
                          layer.setIcon(ic_white);
                      }
                }
            }).addTo(_group1);
var tambon = L.geoJson($tumbon_pol).addTo(map);
map.fitBounds(home.getBounds());
marker.addTo(_group2);

//ประกาศค่าพิกัดในกลุ่ม
var overlays = {
  "บ้านผู้ป่วย":_group1,
  "กำหนดตำแหน่ง":_group2
};

L.control.layers(baseLayers,overlays).addTo(map);

//search
   var searchControl = new L.Control.Search({
   layer: home,
   propertyName: 'SEARCH_TEXT',
   circleLocation: false,

   });
   searchControl.on('search:locationfound', function(e) {

   if(e.layer._popup)e.layer.openPopup();
   }).on('search:collapsed', function(e) {
   pt_layer.eachLayer(function(layer) {
     pt_layer.resetStyle(layer);
   });
   });
   map.addControl( searchControl );
//end-search
JS;
$this->registerJS($js);
?>
