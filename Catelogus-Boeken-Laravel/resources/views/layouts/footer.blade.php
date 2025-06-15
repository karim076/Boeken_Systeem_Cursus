<footer>
    <div class="content-container"></div>
    <div id="map" class="global-map"></div>
    <div class="footer_rights_text">© {{ date('Y') }} Bookshop. All rights reserved.</div>
</footer>

<script type="text/javascript">
    // Wacht tot de DOM volledig geladen is
    document.addEventListener('DOMContentLoaded', function() {
        // Controleer of Leaflet correct geladen is
        if (typeof L === 'undefined') {
            console.error('Leaflet is not loaded properly');
            return;
        }

        // Initialiseer de kaart
        var map = L.map('map', {
            center: [51.5854774, 5.0918566],
            zoom: 17,
            dragging: true,
            touchZoom: false,
            doubleClickZoom: false,
            scrollWheelZoom: false,
            boxZoom: false,
            keyboard: false
        });

        // Voeg tile layer toe
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Markers met popups
        var mosqueIcon = L.icon({
            iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var markerMosque = L.marker([51.5854774, 5.0918566], {
            icon: mosqueIcon
        }).bindPopup(`
            <div class="map-popup">
                <h3>Masjid As-sunnah</h3>
                <h4>Tilburg-Noord</h4>
                <p>Von Suppéstraat 20</p>
                <a href="https://goo.gl/maps/htm885qECxbzpzmD8" style="color=white !important;" target="_blank" class="btn btn-sm btn-primary mt-2">
                    Bekijk op Google Maps
                </a>
            </div>
        `).addTo(map);

        var markerStation = L.marker([51.56054, 5.08129]).bindPopup(`
            <div class="map-popup">
                <h3>Tilburg Centraal Station</h3>
                <p>5041 DL Tilburg</p>
                <a href="https://www.google.com/maps/dir/Centrum,+Tilburg/Von+Supp%C3%A9straat+20"
                   target="_blank" class="btn btn-sm btn-primary mt-2">
                    Routebeschrijving
                </a>
            </div>
        `).addTo(map);

        var markerBus = L.circle([51.58512, 5.08515], {
            radius: 30,
            color: '#007bff',
            fillColor: '#007bff',
            fillOpacity: 0.5
        }).bindPopup(`
            <div class="map-popup">
                <h3>Wagnerplein Bushalte</h3>
                <p>5011 LH Tilburg</p>
                <a href="https://www.google.com/maps/dir/Busstation+wagnerplein/Von+Supp%C3%A9straat+20"
                   target="_blank" class="btn btn-sm btn-primary mt-2">
                    Routebeschrijving
                </a>
            </div>
        `).addTo(map);

        // Open popup voor de moskee
        markerMosque.openPopup();

        // Responsive aanpassingen
        function adjustMapHeight() {
            var windowWidth = window.innerWidth;
            var mapHeight = windowWidth < 768 ? 250 : 350;
            document.getElementById('map').style.height = mapHeight + 'px';
            map.invalidateSize();
        }

        window.addEventListener('resize', adjustMapHeight);
        adjustMapHeight();
    });
</script>

<style>
    .global-map {
        width: 100%;
        height: 350px;
        z-index: 1;
    }

    .map-popup {
        text-align: center;
    }

    .map-popup h3 {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .map-popup h4, .map-popup p {
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .global-map {
            height: 250px;
        }
    }
    .leaflet-container a{
        color: white;
    }
</style>
