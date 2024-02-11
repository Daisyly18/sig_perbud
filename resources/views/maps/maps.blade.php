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

      //jalan
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

      //Batas Kecamatan 
      const stylebataskec = {
          "color": "#FDE767"
      }
      const bataskec = L.geoJSON(batas_kecJSON, {
        style: stylebataskec
      }).addTo(map);

      //Kawasan Hutan
      const stylekawasan = {
        "color" : "#294B29"
      }
      const kawasan = L.geoJSON(kawasan_hutanJSON, {
        style: stylekawasan
      }).addTo(map);

      //Sungai 
      const sungai = L.geoJSON(sungaiJSON).addTo(map);
            
      //Tambak
      const styletambak = {
        "color" : "#706233"        
      }    
      const tambak = L.geoJSON(tambakJSON, {
        style: styletambak,
        onEachFeature: function(feature, layer){
          const numberDiv = document.createElement('div');
          numberDiv.innerHTML = `<b>Number :</b> ${feature.properties.Number}`;

          const luasDiv = document.createElement('div');
          luasDiv.innerHTML = `<b>Luas :</b> ${feature.properties.Luas}`;
       
          const content = document.createElement('div');
          content.appendChild(numberDiv);
          content.appendChild(luasDiv);

          layer.bindPopup(content);
          
        }
      }).addTo(map);

     
      //Batas Kabupaten
      const stylebataskab = {
        "color" : "#BCA37F"
      }
      const bataskab = L.geoJSON(batas_kabJSON, {
        style: stylebataskab
      }).addTo(map);

      // LayerControl
      const baseLayers = {
          "OpenStreetMap": osm,
          "Esri": Esri_WorldImagery
      };
      const overlays = {
          "Tambak": tambak,
          "Sungai": sungai,
          "Jalan": jalan,
          "Adm Kabupaten": bataskab,
          "Adm Kecamatan": bataskec,
          "Kawasan": kawasan
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
    </script>