<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="https://unpkg.com/leaflet.polylinemeasure/Leaflet.PolylineMeasure.js"></script>
<script src="https://unpkg.com/leaflet.defaultextent/dist/leaflet-defaultextent.js"></script>    
<script src="{{ asset('/geojson/batas_kec.js') }}"></script>
<script src="{{ asset('/geojson/jalan.js') }}"></script>
<script src="{{ asset('/geojson/kawasan_hutan.js') }}"></script>
<script src="{{ asset('/geojson/sungai.js') }}"></script>
<script src="{{ asset('/geojson/tambak.js') }}"></script>
<script src="{{ asset('/geojson/batas_kab.js') }}"></script>
<script>  
//Inisialisai peta 
const map = L.map('map', {
  minZoom: 10,
  zoomControl: true,   
  dragging: true,
  trackResize: true,
  measureControl: true
}).setView([0.7355793, 121.6739009], 10);

//Search 
const search = L.Control.geocoder({ position: 'topright'}).addTo(map);      
          
// Tile Layer
const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

const Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
attribution: 'Tiles &copy; Esri &mdash; Source: Esri, and the GIS User Community'
});
Esri_WorldImagery.addTo(map);       


//Batas Kabupaten
// const stylebataskab = {
//   "color" : "#65451F",
//   "weight" : 5,

// }
// const bataskab = L.geoJSON(batas_kabJSON, {
//   style: stylebataskab
// }).addTo(map);

//Batas Kecamatan
const stylebataskec = {
  "color": "#FFA447", 
  "dashArray": "10, 5, 2, 5, 2, 5"
  
}

const bataskec = L.geoJSON(batas_kecJSON, {
  style: stylebataskec, 
  // style: function(feature) {
  //   switch (feature.properties.KECAMATAN) {
  //     case 'PAGUAT' : return {fillColor: "#F28585", weight: 2, fillOpacity:0.7};
  //     case 'DENGILO' : return {fillColor: "#FFA447", weight: 2, fillOpacity:0.7};
  //     case 'MARISA' : return {fillColor: "#FFFC9B", weight: 2, fillOpacity:0.7};
  //     case 'BUNTULIA' : return {fillColor: "#FF6B6B", weight: 2, fillOpacity:0.7};
  //     case 'DUHIADAA' : return {fillColor: "#FFD93D", weight: 2, fillOpacity:0.7};
  //     case 'PATILANGGIO' : return {fillColor: "#6BCB77", weight: 2, fillOpacity:0.7};
  //     case 'TALUDITI' : return {fillColor: "#573391", weight: 2, fillOpacity:0.7};
  //     case 'LEMITO' : return {fillColor: "#681313", weight: 2, fillOpacity:0.7};
  //     case 'RANDANGAN' : return {fillColor: "#E1396C", weight: 2, fillOpacity:0.7};
  //     case 'WANGGARASI' : return {fillColor: "#C3B9EA", weight: 2, fillOpacity:0.7};
  //     case 'POPAYATO' : return {fillColor: "#A03C78", weight: 2, fillOpacity:0.7};
  //     case 'POPAYATO BARAT' : return {fillColor: "#FFF47D", weight: 2, fillOpacity:0.7};
  //     case 'POPAYATO TIMUR' : return {fillColor: "#B1DEB1", weight: 2, fillOpacity:0.7};
  //   }
  // }, 
  onEachFeature: function(feature, layer) {
  // Menambahkan event handler mouseover
  layer.on('mouseover', function() {
    // Simpan style awal polygon
    layer.originalStyle = layer.options.style || {};
    
    layer.setStyle({color: '#E36414' }); // Contoh: Mengubah warna fill menjadi merah saat mouseover
    
    // // Menampilkan popup ketika mouse di atas fitur jalan
    // const popupContent = `<b>KECAMATAN ${feature.properties.KECAMATAN}</b>`;
    // layer.bindPopup(popupContent).openPopup();
  });

  // Menambahkan event handler mouseout
  layer.on('mouseout', function () {
    // Mengembalikan style polygon ke style semula
    layer.setStyle(layer.originalStyle);
  });

  layer.on('click', function() {
    // Menampilkan popup ketika fitur jalan di-klik
    const popupContent = `<b>${feature.properties.KECAMATAN}</b>`;
    layer.bindPopup(popupContent).openPopup();
  });

  }
  }).addTo(map);


  //Kawasan Hutan
  const stylekawasan = {
      "color" : "#42E6A4"
  }
  const kawasan = L.geoJSON(kawasan_hutanJSON, {
    style: stylekawasan,
    onEachFeature: function(feature, layer) {
        // Menampilkan popup ketika mouse di atas fitur
        layer.on('mouseover', function(event) {
            // const popupContent = `<b>${feature.properties.nama_kawasan}</b>`;
            // layer.bindPopup(popupContent).openPopup();
        });
        layer.on('click', function() {
        // Menampilkan popup ketika fitur jalan di-klik
        const popupContent = `<b>${feature.properties.NAMA_KH}</b>`;
        layer.bindPopup(popupContent).openPopup();
    });
    }
  }).addTo(map);


  // //jalan
  const jalan = L.geoJSON(jalanJSON, {
    style: function(feature) {
      switch (feature.properties.REMARK) {
        case 'Jalan Arteri':
            return { color: "#F78CA2", weight: 4 };
        default:
            return { color: "transparent", weight: 0 }; // Mengubah gaya untuk fitur non-arteri
      }
    },

    onEachFeature: function(feature, layer) {    
    layer.on('mouseover', function() {
      // Ubah warna fill atau stroke sesuai kebutuhan
      // layer.setStyle({ color: 'blue' }); // Contoh: Mengubah warna stroke menjadi biru saat mouseover
      // const popupContent = `<b>${feature.properties.REMARK}</b>`;
      // layer.bindPopup(popupContent).openPopup();
    });  
    
    // layer.on('click', function() {
    //   // Menampilkan popup ketika fitur jalan di-klik
    //   const popupContent = `<b>${feature.properties.REMARK}</b>`;
    //   layer.bindPopup(popupContent).openPopup();
    // });
  }
  }).addTo(map);

  //Sungai 
  const sungai = L.geoJSON(sungaiJSON).addTo(map);
    

// Mendapatkan data URL file GeoJSON dari endpoint URL
fetch('/fetch/poligon')
.then(response => response.json())
.then(data => {
    // Panggil fungsi untuk menampilkan GeoJSON pada peta
    displayGeoJSON(data.geojsonData);
});

// Fungsi untuk menampilkan GeoJSON pada peta Leaflet
function displayGeoJSON(geojsonData) {
    geojsonData.forEach(function(geojson) {
        L.geoJSON(geojson, {
            style: function(feature) {
              let color;
                if (feature.properties.status === "Aktif") {
                    color = '#00FF00'; // Hijau untuk Aktif
                } else {
                    color = '#FF0000'; // Merah untuk Tidak Aktif
                }
                return {
                    color: color,
                    fillColor: color,
                    fillOpacity: 0.5
                };
            },
            onEachFeature: function(feature, layer) {
            // Tambahkan popup ke setiap fitur
            const popupContent =
                "<img src='" + feature.properties.imageUrl + "' width='200'>" + "<br>" +
                "<b>Nama Pembudidaya:</b> " + feature.properties.ponds + "<br>" +
                "<b>Kecamatan:</b> " + feature.properties.district + "<br>" +
                "<b>Desa/Kelurahan:</b> " + feature.properties.village + "<br>" +
                "<b>Luas Tambak:</b> " + feature.properties.pondArea + " m^2" + "<br>" +
                "<b>Status:</b> " + feature.properties.status + "<br>" +
                "<b>Jenis Budidaya:</b> " + feature.properties.cultivationType + "<br>" +
                "<b>Tahap Budidaya:</b> " + feature.properties.cultivationStage + "<br>";

                layer.bindPopup(popupContent);
            }
        }).addTo(map);
    });
}


// LayerControl
const baseLayers = {
  "OpenStreetMap": osm,
  "Esri": Esri_WorldImagery
};
const overlays = {
  "Kecamatan": bataskec,
  "Jalan": jalan,
  "Sungai": sungai,
  "Kawasan Hutan": kawasan,
};
L.control.layers(baseLayers, overlays).addTo(map);  



// Zoom Extent
const customControl = L.Control.extend({
  options: {
    position: 'topleft'
  },

  onAdd: function(map) {
    const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');

    // Create button with custom icon
    const button = L.DomUtil.create('a', 'leaflet-control-zoom-extent', container);
    button.title = 'Zoom Extent';
    button.innerHTML = '<i class="fas fa-expand-arrows-alt" style="color: #000"></i>'; 
    button.style.backgroundColor = 'white';
    button.style.padding = '5px';
    button.style.display = 'flex';
    button.style.alignItems = 'center'; // Center vertically
    const icon = button.querySelector('i');
    icon.style.display = 'inline-block';
    icon.style.verticalAlign = 'middle';

    // Set onclick event for the button
    L.DomEvent.on(button, 'click', function(e) {
      L.DomEvent.preventDefault(e); // Prevent the default anchor link behavior
      map.setView([0.7355793, 121.6739009], 10); // Set the original start extent of the map
    });

    return container;
  }
});
map.addControl(new customControl());


//Measure (Titik Jarak)
const measure = L.control.polylineMeasure({
    primaryLengthUnit: 'kilometers', // Satuan panjang default
    secondaryLengthUnit: 'meters', // Satuan panjang sekunder
    primaryAreaUnit: 'hectares', // Satuan area default
    secondaryAreaUnit: 'sqmeters', // Satuan area sekunder
    position: 'topleft', // Posisi kontrol di peta
    title: 'Measure',
    
}).addTo(map);

// Membuat kontrol legenda kustom dengan latar belakang putih
const legendControl = L.control({position: 'bottomleft'});

// Menambahkan metode onAdd untuk menampilkan legenda
legendControl.onAdd = function (map) {
    const div = L.DomUtil.create('div', 'info legend');
    div.style.backgroundColor = 'white'; // Memberikan latar belakang putih
    div.style.width = '170px'; // Menyesuaikan lebar legenda
    div.style.padding = '5px'; // Menambahkan jarak dari tepi
    div.style.borderRadius = '10px'; // Memberikan sudut bulat    
    // Menambahkan judul legenda
    div.innerHTML += '<h6 style="color:black; font-style:arial;">Legenda</h6>';  
    // Menambahkan informasi Batas Kecamatan
    div.innerHTML += '<div style="margin-bottom: 5px;"><svg height="20" width="20"><line x1="0" y1="10" x2="20" y2="10" stroke="#FFA447" stroke-width="3" stroke-dasharray="4, 4" /></svg> Batas Kecamatan</div>';    
    // Menambahkan informasi Jalan
    div.innerHTML += '<div style="margin-bottom: 5px;"><svg height="20" width="20"><line x1="0" y1="10" x2="20" y2="10" stroke="#F78CA2" stroke-width="3" /></svg> Jalan</div>';    
    // Menambahkan informasi Sungai
    div.innerHTML += '<div style="margin-bottom: 5px;"><svg height="20" width="20"><line x1="0" y1="10" x2="20" y2="10" stroke="#387ADF" stroke-width="3" /></svg> Sungai</div>';    
    // Menambahkan informasi Lahan Tambak
    div.innerHTML += '<div style="margin-bottom: 5px;"><svg height="20" width="20"><rect x="0" y="0" width="20" height="20" fill="#AE431E" /></svg> Lahan Tambak</div>';  
    // Menambahkan informasi Kawasan Hutan
    div.innerHTML += '<div style="margin-bottom: 5px;"><svg height="20" width="20"><rect x="0" y="0" width="20" height="20" fill="#42E6A4" /></svg> Kawasan Hutan</div>';
    
    return div;
};
legendControl.addTo(map);




</script>