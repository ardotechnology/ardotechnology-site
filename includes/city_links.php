<?php
/**
 * National Coverage City Links partial
 * Shared between global footer and legacy landing pages.
 */
$cities = [
    "acapulco" => "Acapulco",
    "agua-prieta" => "Agua Prieta",
    "aguascalientes" => "Aguascalientes",
    "alvarado" => "Alvarado",
    "atlacomulco" => "Atlacomulco",
    "atlixco" => "Atlixco",
    "bucerias" => "Bucerías",
    "campeche" => "Campeche",
    "cancun" => "Cancún",
    "cardenas" => "Cárdenas",
    "cdmx" => "CDMX",
    "celaya" => "Celaya",
    "chapala" => "Chapala",
    "chetumal" => "Chetumal",
    "chihuahua" => "Chihuahua",
    "chilpancingo" => "Chilpancingo",
    "ciudad-altamirano" => "Ciudad Altamirano",
    "ciudad-juarez" => "Ciudad Juárez",
    "ciudad-valles" => "Ciudad Valles",
    "ciudad-victoria" => "Ciudad Victoria",
    "colima" => "Colima",
    "cordoba" => "Córdoba",
    "cozumel" => "Cozumel",
    "cuauhtemoc" => "Cuauhtémoc",
    "cuautla" => "Cuautla",
    "cuernavaca" => "Cuernavaca",
    "delicias" => "Delicias",
    "dolores-hidalgo" => "Dolores Hidalgo",
    "durango" => "Durango",
    "ensenada" => "Ensenada",
    "ezequiel-montes" => "Ezequiel Montes",
    "guadalajara" => "Guadalajara",
    "guadalupe-victoria" => "Guadalupe Victoria",
    "guanajuato" => "Guanajuato",
    "guasave" => "Guasave",
    "guaymas" => "Guaymas",
    "hermosillo" => "Hermosillo",
    "huatulco" => "Huatulco",
    "iguala" => "Iguala",
    "irapuato" => "Irapuato",
    "jimenez" => "Jiménez",
    "la-paz" => "La Paz",
    "lazaro-cardenas" => "Lázaro Cárdenas",
    "leon" => "León",
    "loreto" => "Loreto",
    "los-mochis" => "Los Mochis",
    "loscabos" => "Los Cabos",
    "manzanillo" => "Manzanillo",
    "matamoros" => "Matamoros",
    "mazatlan" => "Mazatlán",
    "merida" => "Mérida",
    "mexicali" => "Mexicali",
    "monclova" => "Monclova",
    "monterrey" => "Monterrey",
    "morelia" => "Morelia",
    "nogales" => "Nogales",
    "nuevo-laredo" => "Nuevo Laredo",
    "oaxaca" => "Oaxaca",
    "orizaba" => "Orizaba",
    "pachuca" => "Pachuca",
    "parral" => "Parral",
    "pedro-escobedo" => "Pedro Escobedo",
    "piste" => "Pisté",
    "playa-del-carmen" => "Playa del Carmen",
    "poza-rica" => "Poza Rica",
    "puebla" => "Puebla",
    "puerto-escondido" => "Puerto Escondido",
    "queretaro" => "Querétaro",
    "reynosa" => "Reynosa",
    "rio-verde" => "Río Verde",
    "salamanca" => "Salamanca",
    "saltillo" => "Saltillo",
    "san-jose-iturbide" => "San José Iturbide",
    "san-juan-del-rio" => "San Juan del Río",
    "san-luis-potosi" => "San Luis Potosí",
    "san-miguel-de-allende" => "San Miguel de Allende",
    "santa-rosalia" => "Santa Rosalía",
    "silao" => "Silao",
    "tampico" => "Tampico",
    "tapachula" => "Tapachula",
    "tepeji" => "Tepeji",
    "tequisquiapan" => "Tequisquiapan",
    "tijuana" => "Tijuana",
    "tlaxcala" => "Tlaxcala",
    "toluca" => "Toluca",
    "torreon" => "Torreón",
    "tulum" => "Tulum",
    "tuxtla-gutierrez" => "Tuxtla Gutiérrez",
    "vallarta" => "Vallarta",
    "veracruz" => "Veracruz",
    "villahermosa" => "Villahermosa",
    "xalapa" => "Xalapa",
    "zacatecas" => "Zacatecas",
    "zihuatanejo" => "Zihuatanejo"
];
?>

<div class="footer-cities-links-section"
    style="padding: 60px 0 40px; border-top: 1px solid rgba(0,0,0,0.05); border-bottom: 1px solid rgba(0,0,0,0.05);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h4
            style="margin-bottom: 2.5rem; color: #050505; font-size: 10px; font-weight: 800; opacity: 0.5; letter-spacing: 0.15em; text-transform: uppercase; text-align: center;">
            Presencia Nacional PBX Cloud</h4>
        <div class="footer-cities-grid"
            style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 0.75rem 1.5rem;">
            <?php foreach ($cities as $slug => $name): ?>
                <a href="<?php echo $basePath; ?>telefonia/<?php echo $slug; ?>/"
                    style="text-decoration: none; color: #64748b; font-size: 10px; font-weight: 500; transition: all 0.2s; white-space: nowrap; opacity: 0.6;"
                    onmouseover="this.style.opacity='1'; this.style.color='#00F0FF';"
                    onmouseout="this.style.opacity='0.6'; this.style.color='#64748b';">
                    <?php echo $name; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    @media (max-width: 1024px) {
        .footer-cities-grid {
            grid-template-columns: repeat(4, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        .footer-cities-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
</style>