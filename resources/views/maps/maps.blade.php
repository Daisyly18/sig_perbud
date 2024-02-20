<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@drustack/leaflet.resetview/dist/L.Control.ResetView.min.js"></script>
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
    }
  }).addTo(map);

  //Sungai 
  const sungai = L.geoJSON(sungaiJSON).addTo(map);
    
  //Tambak
  const styletambak = {
    "color": "#706233",
    "fillOpacity":0.9
  };

  // Fungsi untuk menampilkan popup dengan data dari database
  function showPopup(feature, layer) {
    const number = feature.properties.Number; // Ambil nomor dari atribut feature
    fetch(`/tambak/${number}`) // Kirim permintaan ke endpoint backend server
      .then(response => response.json())
      .then(data => {
        // Buat konten popup dengan informasi tambak
        const popupContent = `
          <b>Number:</b> ${number}<br>
          <b>Nama Pembudidaya:</b> ${data.ponds}<br>
          <b>Kecamatan:</b> ${data.district}<br>
          <b>Desa:</b> ${data.village}<br>
          <b>Gambar Tambak:</b> <img src="${data.imagePonds}" alt="Gambar Tambak" width="100"><br>
          <b>Status:</b> ${data.status}<br>
          <b>Jenis Budidaya:</b> ${data.cultivationType}<br>
          <b>Tahap Budidaya:</b> ${data.cultivationStage}<br>
        `;
        // Tampilkan popup pada peta
        layer.bindPopup(popupContent).openPopup();
      })
      .catch(error => console.error('Error:', error));
  }

  

  // Membuat layer GeoJSON dan menambahkan style dan fungsi onEachFeature
  const tambak = L.geoJSON(tambakJSON, {
    style: styletambak, 
    onEachFeature: function (feature, layer) {
      layer.on('click', function () {
        showPopup(feature, layer); 
      });
    }
  }).addTo(map);

  
  // LayerControl
  const baseLayers = {
      "OpenStreetMap": osm,
      "Esri": Esri_WorldImagery
  };
  const overlays = {
  "Tambak": tambak,
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
    button.style.padding = '5px';
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

// Variabel global untuk menyimpan koordinat vertex polygon yang sedang digambar
var tempPolygonCoordinates = [];

// Variabel global untuk menyimpan polygon yang sedang digambar
var tempPolygon;

// Fungsi untuk memulai pembuatan polygon
function startDrawingPolygon() {
    tempPolygonCoordinates = []; // Mengosongkan array koordinat sementara
    tempPolygon = L.polyline([]).addTo(map); // Membuat polyline baru (polygon yang belum selesai) dan menambahkannya ke peta
}

// Fungsi untuk menambahkan koordinat pada polygon yang sedang digambar
function addCoordinateToPolygon(e) {
    tempPolygonCoordinates.push(e.latlng); // Menambah koordinat baru ke dalam array sementara
    tempPolygon.setLatLngs(tempPolygonCoordinates); // Menetapkan koordinat baru ke polyline (polygon yang belum selesai)
    
    // Memperbarui koordinat polygon di elemen HTML setiap kali koordinat ditambahkan
    updatePolygonCoordinates(tempPolygon);
}

// Fungsi untuk menampilkan koordinat polygon di elemen HTML
function updatePolygonCoordinates(polygon) {
    var coordinates = polygon.getLatLngs(); // Mendapatkan array koordinat vertex polygon
    var coordinateString = "";

    // Mengonversi array koordinat menjadi string yang dapat dibaca
    for (var i = 0; i < coordinates.length; i++) {
        coordinateString += coordinates[i].lat + "," + coordinates[i].lng + "; ";
    }

    // Memasukkan string koordinat ke dalam elemen HTML
    document.getElementById("geojsonPonds").value = coordinateString.trim(); // Menghilangkan spasi ekstra di akhir
}

// Menambahkan event listener untuk menggambar polygon dengan beberapa klik
map.on('click', function(e) {
    if (tempPolygonCoordinates.length === 0) {
        startDrawingPolygon(); // Memulai pembuatan polygon jika belum ada koordinat yang ditambahkan
    }

    addCoordinateToPolygon(e); // Menambahkan koordinat saat pengguna mengklik peta
});

// Menambahkan event listener untuk tombol "Mulai Menggambar"
document.getElementById('startDrawingBtn').addEventListener('click', startDrawingPolygon);

// Menambahkan tombol-tombol untuk mengontrol pembuatan polygon
document.getElementById('finishDrawingBtn').addEventListener('click', finishDrawingPolygon);

// Fungsi untuk menyelesaikan pembuatan polygon
function finishDrawingPolygon() {
    // Menghapus polyline (polygon yang belum selesai) dari peta
    map.removeLayer(tempPolygon);

    // Membuat polygon baru dari koordinat yang telah ditentukan
    var drawnPolygon = L.polygon(tempPolygonCoordinates).addTo(map);

    // Memperbarui koordinat polygon di elemen HTML
    updatePolygonCoordinates(drawnPolygon);
}






</script>