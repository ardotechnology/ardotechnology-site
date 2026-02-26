# ARDO Technology - Portal de Clientes

Este es el portal de clientes y panel de control para los servicios de PBX Cloud y Telefonía de ARDO Technology. 

## Estructura

- `/dashboard`: Interfaz de usuario para clientes finales (facturación, reportes de llamadas, compra de números, recargas de saldo).
- `/modules/switches`: Módulo backend integrado con Perfex CRM para la administración de troncales, sincronización de llamadas y reportes.

## Requisitos

- PHP 7.4+
- Base de datos MySQL / MariaDB
- Perfex CRM (Core)
- API Token (Configurado en `dashboard/config.php`)

## Instalación

1. Clonar el repositorio.
2. Copiar `dashboard/config.example.php` a `dashboard/config.php` y configurar la conexión a la base de datos y el `API_TOKEN`.
3. El módulo de switches debe estar instalado en la carpeta `modules` del CRM.

## Seguridad

Las credenciales de base de datos y los tokens de API están ignorados en el control de versiones. Nunca se deben hacer commit a archivos `.env` o `config.php` modificados.
