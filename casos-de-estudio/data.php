<?php
$casos = [
    [
        'id' => 1,
        'slug' => 'diseno-infraestructura-voz-y-datos',
        'title' => 'Diseño de infraestructura de voz y datos.',
        'client_name' => 'GPD Business Center',
        'category' => 'INFRAESTRUCTURA',
        'image' => '../images/casos/infragpd.jpg',
        'logo_html' => '<svg width="60" height="60" viewBox="0 0 100 100" fill="white"><rect x="25" y="45" width="25" height="25" rx="2" transform="rotate(45 37.5 57.5)" opacity="0.6" /><rect x="45" y="25" width="25" height="25" rx="2" transform="rotate(45 57.5 37.5)" /></svg>',
        'overlay_class' => '',
        'short_description' => 'GPD Business Center es una empresa que desea ser líder en el servicio de renta de espacios de trabajo como oficinas, salas de juntas y espacios de co-work All-Inclusive en diferentes puntos de la ciudad de Querétaro.',
        'features' => [
            'Cableado Estructurado',
            'Instalación de Equipo Activo'
        ],
        'challenge_image' => '../images/casos/challenge.jpg',
        'challenge_html' => '<h2>El Reto.</h2>
<p>GPD Business Center, un centro de negocios dedicado a la renta de oficinas físicas y virtuales en Querétaro, está en un proceso de crecimiento y consolidación de mercado por la alta calidad de sus servicios.</p>
<p>En su estrategía de crecimiento, ARDO Technology participó en el diseño e implementación de la red de voz y datos sobre la que funcionarían todos los servicios de conectividad en una nueva ubicación de su último centro de negocios.</p>
<p>Se necesitaba un enlace de internet que soportara la carga de trabajo y fuera resiliente, proteger los equipos ante posibles descargas eléctricas, cablear de manera estructurada todo el centro y diseñar al interior la red, nodos y equipos activos que gestionarían el trafico interno y externo.</p>',

        'solution_html' => '<h2>La Solución.</h2>
<p>Se trabajó con el despacho de arquitectura, equipo directivo y operativo para verificar las necesidades del proyecto.</p>
<p>Se realizó la instalación del cableado CAT-6 de acuerdo a la normativa y necesidades del centro para asegurarnos que cada una de las oficinas, espacio de sala de juntas y co-work tuvieran conexión alámbrica.</p>
<p>Se instaló un servicio de internet dedicado, gestionado por ARDO Technology como integrador autorizado de Alestra y se instalaron equipos activos como TPLink con tecnología OMADA para proveer conectividad de manera inalambrica, Grandstream para el servicio de Telefonía IP implementada por nosotros como Carrier de Telecomunicaciones.</p>
<p>Para reducir costos y mantener monitoreado el consumo eléctrico se instalaron interruptores inteligentes TPLink.</p>',
        'results' => [
            'Los clientes tienen un servicio de internet estable para sus actividades de trabajo.',
            'El equipo de operaciones y administrativo tiene acceso a sus aplicativos en la nube para la administración y operación.',
            'Mayor satisfacción del cliente al contar con un servicio estable y redundante de internet.',
            'Diseño escalable de acuerdo a las necesidades de la operacion.',
            'Soporte técnico más eficiente al haber diseñado la red para ser monitoreada de manera remota.',
            'Reducción en los servicios de soporte de telefonía sobre datos.'
        ],
        'technologies' => ['Alestra', 'Asterisk', 'Ubiquiti', 'Grandstream', 'Oracle Cloud Infrastructure']
    ],
    [
        'id' => 2,
        'slug' => 'telefonia-voip-operaciones-remotas',
        'title' => 'Solución de telefonía VOIP en la nube para operaciones remotas.',
        'client_name' => 'TSK',
        'category' => 'VOIP',
        'image' => '../images/casos/solution.webp',
        'logo_html' => '<span style="font-size: 2.2rem; font-weight: 900; letter-spacing: -1px; font-family: sans-serif;">TaSK</span>',
        'overlay_class' => 'dark',
        'short_description' => 'TSK tiene operaciones en lugares remotos de México donde la conectividad telefónica es muy limitada. Sus equipos enfrentaban grandes dificultades para comunicarse por teléfono con clientes y proveedores.',
        'features' => [
            'Infraestructura Cloud',
            'Telefonía VOIP'
        ],
        'challenge_image' => '../images/casos/challenge.jpg', // Reusing for consistency unless specific requested
        'challenge_html' => '<h2>El Reto.</h2>
<p>La empresa TSK tiene operaciones en lugares remotos de México donde la conectividad telefónica es muy limitada. Sus equipos enfrentaban grandes dificultades para comunicarse por teléfono con clientes, proveedores y la matriz en España.</p>
<p>La falta de infraestructura telefónica robusta y confiable en esas remotas locaciones resultaba en fallas constantes en las llamadas, cortes abruptos, imposibilidad de transferir llamadas y pérdida de mensajes.</p>
<p>La gerencia de TSK determinó que requerían con urgencia implementar una solución de telefonía estable, segura y centralizada que permitiera una comunicación fluida entre sus equipos sin importar la ubicación remota.</p>',

        'solution_html' => '<h2>La Solución.</h2>
<p>Luego de evaluar diversas opciones, ARDO Technology eligió implementar una innovadora solución de PBX Virtual basada en la flexible y escalable nube de Oracle.</p>
<p>ARDO Technology diseñó e implementó esta plataforma de telefonía VOIP y PBX administrada en la nube, incluyendo troncales y numeración provista por nuestra compañía como Carrier de telecomunicaciones.</p>
<p>Se desplegaron modernos teléfonos IP Grandstream en cada locación remota, asignando extensiones individuales y números telefónicos directos para los principales ejecutivos.</p>',
        'results' => [
            'Se resolvieron los problemas de telefonía y se unificaron las comunicaciones remotas con VOIP.',
            'Las llamadas ahora se realizan sin interrupciones ni cortes.',
            'La gerencia puede transferir y monitorizar llamadas fácilmente.',
            'Incremento notable de la productividad con una plataforma telefónica confiable.',
            'Se logró predictibilidad en los costos telefónicos mensuales.'
        ],
        'technologies' => ['Oracle Cloud', 'Grandstream', 'VoIP', 'SIP Trunking']
    ],
    [
        'id' => 3,
        'slug' => 'aplicativo-web-para-administrar-centros-de-negocios',
        'title' => 'Aplicativo web para la administración de Centros de Negocios.',
        'client_name' => 'GPD Business Center',
        'category' => 'TRANSFORMACIÓN DIGITAL',
        'image' => '../images/inicio.jpg',
        'logo_html' => '<svg width="60" height="60" viewBox="0 0 100 100" fill="white"><rect x="25" y="45" width="25" height="25" rx="2" transform="rotate(45 37.5 57.5)" opacity="0.6" /><rect x="45" y="25" width="25" height="25" rx="2" transform="rotate(45 57.5 37.5)" /></svg>',
        'overlay_class' => '',
        'short_description' => 'GPD Business Center es una empresa que desea ser líder en el servicio de renta de espacios de trabajo como oficinas, salas de juntas y espacios de co-work All-Inclusive en diferentes puntos de la ciudad de Querétaro.',
        'features' => [
            'Infraestructura Cloud',
            'Desarrollo de Software'
        ],
        'challenge_image' => '../images/casos/challenge.jpg',
        'challenge_html' => '<h2>El Reto.</h2>
<p>GPD Business Center operaba con procesos manuales que resultaban en alto riesgo de errores y pérdida de información. Preparar estados de cuenta o información sobre servicios para clientes era lento y tardado.</p>
<p>Los procesos clave identificados para optimizar fueron: facturación, gestión de información de clientes/membresías y administración de espacios como oficinas y salas de juntas.</p>
<p>Intentaron previamente un software que no se adecuó a sus necesidades y solo servía como gestor de archivos. Requerían automatizar estos procesos críticos para mejorar la experiencia de clientes.</p>',

        'solution_html' => '<h2>La Solución.</h2>
<p>Se desarrolló un ERP personalizado con módulos para automatizar los procesos críticos de GPD Business Center: CRM, clientes, administración de espacios físicos y facturación.</p>
<p>La aplicación web basada en PHP, MySQL, jQuery y Bootstrap es accesible desde cualquier lugar con controles de usuario.</p>
<p>Entre los módulos, destaca facturación siguiendo especificaciones del SAT para concentrar operaciones por cliente, emitir facturas integrando un servicio de API y posteriormente enviarlas por correo electrónico.</p>',
        'results' => [
            'Reducción del tiempo de atención a clientes con información actualizada en tiempo real.',
            'Disminución del error humano al automatizar procesos de cargos y facturación.',
            'Crecimiento y estandarización del servicio en todos los centros de negocios aperturados.',
            'Predicción de ingresos con el monitoreo de pagos, cuentas por cobrar y pagar.',
            'Disponibilidad de la información en cualquier momento a través de la infraestructura en nube.'
        ],
        'technologies' => ['PHP', 'MySQL', 'Bootstrap', 'jQuery', 'Facturama API']
    ]
];
?>