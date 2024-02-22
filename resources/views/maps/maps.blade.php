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
  }).setView([0.7355793, 121.6739009], 10);
  
  //Search 
  L.Control.geocoder({ position: 'topright'}).addTo(map);      
            
  // Tile Layer
  const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  const Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
  attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
  });
  Esri_WorldImagery.addTo(map);       


  //Batas Kabupaten
  const stylebataskab = {
    "color" : "#F58B54",
    "weight" : 5,
    "fillOpacity" :0
  }
  const bataskab = L.geoJSON(batas_kabJSON, {
    style: stylebataskab
  }).addTo(map);

  //Batas Kecamatan
  const bataskec = L.geoJSON(batas_kecJSON, {
    style: function(feature) {
      switch (feature.properties.KECAMATAN) {
        case 'PAGUAT' : return {fillColor: "#F28585", weight: 2, fillOpacity:0.7};
        case 'DENGILO' : return {fillColor: "#FFA447", weight: 2, fillOpacity:0.7};
        case 'MARISA' : return {fillColor: "#FFFC9B", weight: 2, fillOpacity:0.7};
        case 'BUNTULIA' : return {fillColor: "#FF6B6B", weight: 2, fillOpacity:0.7};
        case 'DUHIADAA' : return {fillColor: "#FFD93D", weight: 2, fillOpacity:0.7};
        case 'PATILANGGIO' : return {fillColor: "#6BCB77", weight: 2, fillOpacity:0.7};
        case 'TALUDITI' : return {fillColor: "#573391", weight: 2, fillOpacity:0.7};
        case 'LEMITO' : return {fillColor: "#681313", weight: 2, fillOpacity:0.7};
        case 'RANDANGAN' : return {fillColor: "#E1396C", weight: 2, fillOpacity:0.7};
        case 'WANGGARASI' : return {fillColor: "#C3B9EA", weight: 2, fillOpacity:0.7};
        case 'POPAYATO' : return {fillColor: "#A03C78", weight: 2, fillOpacity:0.7};
        case 'POPAYATO BARAT' : return {fillColor: "#FFF47D", weight: 2, fillOpacity:0.7};
        case 'POPAYATO TIMUR' : return {fillColor: "#B1DEB1", weight: 2, fillOpacity:0.7};
      }
    }, 
    onEachFeature: function(feature, layer) {
    // Menambahkan event handler mouseover
    layer.on('mouseover', function() {
      // Menampilkan popup ketika mouse di atas fitur jalan
      const popupContent = `<b>${feature.properties.KECAMATAN}</b>`;
      layer.bindPopup(popupContent).openPopup();
    });

    // Menambahkan event handler click
    layer.on('click', function() {
      // Menampilkan popup ketika fitur jalan di-klik
      const popupContent = `<b>${feature.properties.KECAMATAN}</b>`;
      layer.bindPopup(popupContent).openPopup();
    });
  }
  }).addTo(map);


  //Kawasan Hutan
  const stylekawasan = {
      "color" : "#294B29"
  }
  const kawasan = L.geoJSON(kawasan_hutanJSON, {
    style: stylekawasan
  }).addTo(map);

  // //jalan
  const jalan = L.geoJSON(jalanJSON, {
    style: function(feature) {
      switch (feature.properties.REMARK) {
        case 'Jalan Arteri':return {color: "#B70404"};
        case 'Jalan Lokal': return {color: "#607274"};
        case 'Jalan Setapak': return {color: "#597E52"};
        case 'Jalan Lain': return {color: "#6B240C"}; 
      }
    }, 
    onEachFeature: function(feature, layer) {
    // Menambahkan event handler mouseover
    layer.on('mouseover', function() {
      // Ubah warna fill atau stroke sesuai kebutuhan
      layer.setStyle({ color: 'blue' }); // Contoh: Mengubah warna stroke menjadi biru saat mouseover
      const popupContent = `<b>${feature.properties.REMARK}</b>`;
      layer.bindPopup(popupContent).openPopup();
    });  
    layer.on('click', function() {
      // Menampilkan popup ketika fitur jalan di-klik
      const popupContent = `<b>${feature.properties.REMARK}</b>`;
      layer.bindPopup(popupContent).openPopup();
    });
  }
  }).addTo(map);

  //Sungai 
  const sungai = L.geoJSON(sungaiJSON).addTo(map);  

//Tambak
const styletambak = {
    "color": "#B70404",
    "fillOpacity":0.9
  }

  
  let poligonData = {}; // Inisialisasi dengan objek kosong

const poligon = () => {
  try {
    return fetch('fetch/poligon') // Menggunakan return agar dapat menangkap hasil promise
      .then(response => response.json())
      .then(data => {
        poligonData = data; // Mengisi data ke dalam poligonData (tanpa const)
        console.log(poligonData); // Contoh: Menampilkan data ke konsol
      })
      .catch(error => {
        console.log(error);
      });
  } catch (error) {
    console.log(error);
  }
};

// Memanggil fungsi poligon
poligon()
  .then(() => {
    // Membuat layer GeoJSON dan menambahkan style dan fungsi onEachFeature
    const tambak = L.geoJSON(poligonData, {
      style: function (feature) {
        return {
          "color": "#B70404",
          "fillOpacity":0.9
        };
      },
      onEachFeature: function (feature, layer) {
        // Menambahkan event handler mouseover
        layer.on('mouseover', function () {
          layer.setStyle({ fillColor: 'blue' }); // Contoh: Mengubah warna fill menjadi biru saat mouseover
        });

        // Menambahkan event handler mouseout
        layer.on('mouseout', function () {
          layer.setStyle({ fillColor: '#B70404' }); // Contoh: Mengembalikan warna fill menjadi semula saat mouseout
        });

        layer.on('click', function () {
          showPopup(feature, layer); 
        });
      }
    }).addTo(map);
  })
  .catch(error => {
    console.log(error);
  });
  function showPopup(feature, layer) {
  // Ganti dengan konten popup yang sesuai dengan data poligon
  const popupContent = `
    <h3>${feature.properties.name}</h3>
    <p>Informasi tambahan</p>
  `;
  layer.bindPopup(popupContent).openPopup();
}


// LayerControl
const baseLayers = {
      "OpenStreetMap": osm,
      "Esri": Esri_WorldImagery
  };
  const overlays = {
  "Adm Kabupaten": bataskab,
  "Adm Kecamatan": bataskec,
  "Sungai": sungai,
  "Jalan": jalan,
  "Kawasan Hutan": kawasan
};


L.control.layers(baseLayers, overlays).addTo(map);          

//Zoom Extent
const customControl = L.Control.extend({
  options: {
    position: 'topleft'
  },

  onAdd: function(map) {
    const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');

    // Create button with custom icon
    const button = L.DomUtil.create('a', 'leaflet-control-zoom-extent', container);
    button.href = '#';
    button.title = 'Zoom Extent';
    button.innerHTML = '<i class="fas fa-expand-arrows-alt"></i>'; 
    button.style.backgroundColor = 'white';
    button.style.padding = '7px';
    button.style.display = 'flex';
    button.style.justifyContent = 'center'; // Center horizontally
    button.style.alignItems = 'center'; // Center vertically

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
const Measure = L.control.polylineMeasure({
        position: 'topleft',
        title: 'Measure'
}).addTo(map);


</script>