document.addEventListener('DOMContentLoaded', function() {
    const popupOverlay = document.getElementById('ardo-popup-overlay');
    const popupClose = document.getElementById('ardo-popup-close');
    const popupForm = document.getElementById('ardo-popup-form');
    
    // Configuración heredada (esto idealmente se pasaría desde PHP, pero usaremos valores por defecto o globales)
    const delay = 3000; // ms
    const storageKey = 'ardo_partner_popup_shown';
    
    // Verificar si ya se mostró (si show_once está activo)
    if (localStorage.getItem(storageKey)) {
        return;
    }
    
    // Mostrar el popup con retraso
    setTimeout(() => {
        popupOverlay.style.display = 'flex';
        // Forzar reflow para animación
        void popupOverlay.offsetWidth;
        popupOverlay.classList.add('active');
    }, delay);
    
    // Cerrar el popup
    function closePopup() {
        popupOverlay.classList.remove('active');
        setTimeout(() => {
            popupOverlay.style.display = 'none';
        }, 400); // Mismo tiempo que la transición CSS
        
        // Guardar que ya se mostró
        localStorage.setItem(storageKey, 'true');
    }
    
    popupClose.addEventListener('click', closePopup);
    
    // Cerrar al hacer clic fuera del contenido
    popupOverlay.addEventListener('click', function(e) {
        if (e.target === popupOverlay) {
            closePopup();
        }
    });
    
    // Manejo del formulario
    popupForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(popupForm);
        const name = formData.get('name');
        const email = formData.get('email');
        const phone = formData.get('phone');
        
        // Construir mensaje de WhatsApp
        const baseUrl = 'https://wa.me/524429803200';
        const baseMessage = '¡Hola! Me interesa información sobre el programa de Partners de ARDO Technology.';
        const detailedMessage = `${baseMessage}\n\n*Mis Datos:*\n- Nombre: ${name}\n- Correo: ${email}\n- Teléfono: ${phone}`;
        
        const fullUrl = `${baseUrl}?text=${encodeURIComponent(detailedMessage)}`;
        
        // Guardar persistencia antes de redirigir
        localStorage.setItem(storageKey, 'true');
        
        // Redirigir
        window.open(fullUrl, '_blank');
        
        // Cerrar el popup después de abrir WhatsApp
        closePopup();
    });
});
