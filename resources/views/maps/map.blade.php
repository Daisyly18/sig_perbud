<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
<script src="https://unpkg.com/leaflet-draw-toolbar@1.0.4/dist/leaflet.draw.toolbar.js"></script>
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
     
            
  // Tile Layer
  const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);



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

  

  
  // LayerControl
  const baseLayers = {
      "OpenStreetMap": osm,
  };
  const overlays = {
  "Adm Kabupaten": bataskab,
  "Adm Kecamatan": bataskec,
  "Jalan": jalan,
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

// //Measure (Titik Jarak)
// const Measure = L.control.polylineMeasure({
//         position: 'topleft',
//         title: 'Measure'
// }).addTo(map);

// Variabel global untuk menyimpan koordinat vertex poligon yang sedang digambar
var tempPolygonCoordinates = [];
// Variabel global untuk menyimpan poligon yang sedang digambar
var tempPolygon;
// Variabel global untuk menyimpan ID poligon yang sedang digambar
var polygonIDCounter = 1;
// Variabel global untuk menentukan apakah penggambaran sedang diaktifkan
var drawingEnabled = true; // Diaktifkan secara default

// Fungsi untuk memulai pembuatan poligon
function startDrawingPolygon() {
    tempPolygonCoordinates = []; // Mengosongkan array koordinat sementara
    tempPolygon = L.polygon([]).addTo(map); // Membuat poligon baru dan menambahkannya ke peta
    tempPolygon._polygonID = polygonIDCounter++; // Menetapkan ID otomatis untuk poligon yang dibuat

    // Memperbarui status penggambaran menjadi aktif
    drawingEnabled = true;
}

// Fungsi untuk menambahkan koordinat ke poligon yang sedang digambar
function addCoordinateToPolygon(e) {
    tempPolygonCoordinates.push(e.latlng); // Menambahkan koordinat baru ke dalam array sementara
    tempPolygon.setLatLngs(tempPolygonCoordinates); // Menetapkan koordinat baru ke poligon yang belum selesai

    // Memperbarui koordinat poligon di elemen HTML setiap kali koordinat ditambahkan
    updatePolygonCoordinates();
}

// Event listener untuk menggambar poligon dengan beberapa klik
map.on('click', function(e) {
    if (drawingEnabled) {
        if (tempPolygonCoordinates.length === 0) {
            startDrawingPolygon(); // Memulai pembuatan poligon jika belum ada koordinat yang ditambahkan
        }

        addCoordinateToPolygon(e); // Menambahkan koordinat saat pengguna mengklik peta
    }
});

// Function untuk memperbarui koordinat poligon di elemen HTML
function updatePolygonCoordinates() {
    var coordinateArray = [];

    // Mengonversi array koordinat menjadi array JSON
    for (var i = 0; i < tempPolygonCoordinates.length; i++) {
        coordinateArray.push([tempPolygonCoordinates[i].lng, tempPolygonCoordinates[i].lat]);
    }

    // Menyiapkan objek JSON yang berisi koordinat poligon
    var polygonJSON = {
        "type": "MultiPolygon",
        "coordinates": [[coordinateArray]]
    };

    // Memasukkan string JSON ke dalam elemen HTML
    document.getElementById("coordinate").value = JSON.stringify(polygonJSON);
}
// Fungsi untuk menyelesaikan pembuatan polygon
function finishDrawingPolygon() {
    // Menghapus polyline (polygon yang belum selesai) dari peta
    map.removeLayer(tempPolygon);

    // Memeriksa apakah jumlah koordinat yang ditambahkan cukup untuk membuat polygon
    if (tempPolygonCoordinates.length < 3) {
        alert('Minimal 3 titik koordinat diperlukan untuk membuat polygon.');
        return;
    }

    // Memeriksa jarak antara koordinat pertama dan terakhir
    var firstCoordinate = tempPolygonCoordinates[0];
    var lastCoordinate = tempPolygonCoordinates[tempPolygonCoordinates.length - 1];
    var distance = calculateDistance(firstCoordinate, lastCoordinate);

    // Memeriksa apakah jarak antara koordinat pertama dan terakhir sesuai dengan yang diinginkan
    var acceptableDistance = 0.1; // Ganti dengan jarak yang diinginkan (dalam satuan yang sesuai dengan proyek Anda)
    if (distance > acceptableDistance) {
        alert('Jarak antara titik koordinat pertama dan terakhir tidak sesuai.');
        return;
    }

    // Membuat polygon baru dari koordinat yang telah ditentukan
    var drawnPolygon = L.polygon(tempPolygonCoordinates).addTo(map);
    drawnPolygon._polygonID = tempPolygon._polygonID; // Mengatur ID polygon baru

    // Memperbarui koordinat polygon di elemen HTML
    updatePolygonCoordinates();
}

// Create delete polygon control
const deleteControl = L.control({
    position: 'topleft'
});

// Function to set up delete control
deleteControl.onAdd = function() {
    const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');

    // Create button for deleting polygon with custom icon
    const deleteButton = L.DomUtil.create('a', 'leaflet-control-delete', container);
    deleteButton.href = '#';
    deleteButton.title = 'Delete Polygon';
    deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
    deleteButton.style.backgroundColor = 'white';
    deleteButton.style.padding = '5px';
    deleteButton.style.display = 'flex';
    deleteButton.style.alignItems = 'center';

    // Set onclick event for the delete button
    L.DomEvent.on(deleteButton, 'click', function(e) {
        L.DomEvent.preventDefault(e); // Prevent the default anchor link behavior
        deletePolygon();                  
        // Set drawingEnabled to false to disable drawing after deletion
        drawingEnabled = false;     
        L.DomEvent.stopPropagation(e);  
        // Tambahkan event listener ke peta untuk menanggapi klik pengguna setelah penghapusan poligon
        map.once('click', function(e) {
            // Mulai menggambar poligon baru dari titik klik pengguna
            startDrawingPolygon();
            addCoordinateToPolygon(e);
    })   ;
    });

    return container;
};

// Add control to the map
deleteControl.addTo(map);


// Function untuk menghapus poligon
function deletePolygon() {
    if (tempPolygon) {
        map.removeLayer(tempPolygon); // Menghapus poligon yang sedang digambar dari peta
        tempPolygon = null; // Mengatur nilai tempPolygon menjadi null untuk menghapus referensi
        tempPolygonCoordinates = []; // Mengosongkan array koordinat sementara        
        // Menghapus isi textarea
        document.getElementById("coordinate").value = "";   
        
      }
}






 










</script>