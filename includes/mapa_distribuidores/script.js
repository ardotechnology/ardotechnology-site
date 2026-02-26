document.addEventListener('DOMContentLoaded', () => {
    // Initialize the map centered on Mexico
    // Coordenadas aproximadas del centro de México
    const map = L.map('map', {
        scrollWheelZoom: false,
        dragging: false,      // Disable panning
        tap: false,           // Disable tap
        touchZoom: false      // Disable pinch zoom
    }).setView([23.6345, -102.5528], 5);

    // Enable all interactions only after click
    map.on('click', () => {
        map.scrollWheelZoom.enable();
        map.dragging.enable();
        if (map.tap) map.tap.enable();
        map.touchZoom.enable();
    });

    // Optional: Disable it again when mouse leaves the map area?
    // map.on('mouseout', () => {
    //     map.scrollWheelZoom.disable();
    // });

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Fetch the distributors data
    fetch('distributors.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar el archivo de datos');
            }
            return response.json();
        })
        .then(data => {
            const markers = [];
            // Define custom icon
            const customIcon = L.icon({
                iconUrl: 'images/icon-1.png',
                iconSize: [20, 20],
                iconAnchor: [10, 20],
                popupAnchor: [0, -20]
            });

            data.forEach(distributor => {
                if (distributor.lat && distributor.lng) {
                    // Use the custom icon
                    const marker = L.marker([distributor.lat, distributor.lng], { icon: customIcon }).addTo(map);

                    const popupContent = `
                        <div class="popup-content">
                            <h3>${distributor.name}</h3>
                            <p><strong>Dirección:</strong> ${distributor.address}</p>
                            <p><strong>Teléfono:</strong> <a href="tel:${distributor.phone}">${distributor.phone}</a></p>
                            <p><strong>Email:</strong> <a href="mailto:${distributor.email}">${distributor.email}</a></p>
                            <p><strong>Web:</strong> <a href="${distributor.website}" target="_blank">Visitar sitio</a></p>
                        </div>
                    `;

                    marker.bindPopup(popupContent);
                    markers.push(marker);
                }
            });

            // If we have markers, fit bounds to show them all
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds());
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Fallback for local testing warning
            alert('Nota: Si abres este archivo localmente, es posible que el navegador bloquee la carga del JSON por seguridad (CORS). Usa un servidor local o sube los archivos a un hosting.');
        });
});
