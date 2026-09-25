# Safey — servicios PHP para pasajes interprovinciales

Backend de un proyecto académico de equipo sobre búsqueda de viajes y venta de
pasajes de buses en Ecuador. Se conserva como registro del trabajo realizado y
de su integración con clientes web y móviles.

**Estado: prototipo académico. Tiene problemas conocidos de autenticación,
autorización y consistencia de ventas. No está preparado para un despliegue
público ni para gestionar cuentas o compras reales.**

## Qué implementa

- Registro, edición y consultas de cooperativas, buses y asientos.
- Frecuencias, paradas y viajes diarios, con búsquedas por origen y destino.
- Registro de pasajeros y socios; consultas y edición de perfiles.
- Creación de ventas y sus detalles, consulta de compras y actualización de su
  estado. Los importes, códigos QR y comprobantes se reciben del cliente.

Los servicios son scripts PHP que reciben parámetros GET o POST, ejecutan
consultas MySQL con `mysqli` y devuelven JSON. Cada archivo es un endpoint;
no hay un framework ni una capa compartida de autorización. La mayoría de las
consultas se construyen concatenando parámetros. `login.php` utiliza una
consulta preparada, pero eso no protege los demás servicios.

## Organización

Todos los endpoints están en la raíz del repositorio:

| Área | Archivos de ejemplo |
| --- | --- |
| Usuarios | `login.php`, `registroPasajero.php`, `editarPerfilUsuario.php` |
| Flota | `agregarBus.php`, `editarAsiento.php`, `listarBuses.php` |
| Rutas y viajes | `agregarFrecuencia.php`, `agregarViajeDiario.php`, `buscarViaje.php` |
| Ventas | `generarVenta.php`, `ingresarDetalleVenta.php`, `listarCompras.php` |
| Conexión | `conexionBDRemota.php` |

## Limitaciones relevantes

- Los endpoints de negocio no verifican sesión, rol ni propiedad de los datos.
- Las contraseñas se escriben y comparan directamente; existen endpoints que
  las devuelven y otros que las cambian sin verificar identidad.
- Numerosas consultas interpolan entradas sin parametrizar.
- El servidor acepta importes enviados por el cliente. Crear una venta y sus
  detalles requiere peticiones independientes, sin transacción compartida.
- La consulta de asientos disponibles usa el estado del asiento por bus, sin
  comprobar las reservas del viaje concreto.
- No hay tests automatizados ni CI. El esquema SQL no está versionado aquí.

El análisis y los criterios para una posible recuperación están en
[Limitaciones y trabajo pendiente](docs/limitaciones.md). La configuración por
variables de entorno evita guardar nuevas credenciales en el código; no
corrige los problemas de los endpoints.

## Revisión local

Se requiere PHP con las extensiones `mysqli`, `json` y `session`, y una base
MySQL compatible con las tablas utilizadas por los servicios. Este repositorio
por sí solo no permite reconstruir la base de datos.

1. Obtener y revisar el esquema del proyecto; crear una base local con datos
   de prueba. Los enlaces históricos están más abajo y su disponibilidad no
   está verificada.
2. Copiar `.env.example` a `.env` y completar las cuatro variables `DB_*`.
   `.env` está ignorado por Git.
3. Cargar las variables en el proceso PHP. El proyecto **no carga `.env`
   automáticamente**. Para una revisión local desde una shell POSIX:

   ```sh
   set -a
   . ./.env
   set +a
   php -S 127.0.0.1:8000
   ```

   El archivo `.env` se interpreta como código de shell: utiliza únicamente
   tu archivo local y valores entre comillas simples como en el ejemplo.
4. Consultar un endpoint de lectura, por ejemplo `listarFrecuencias.php`.
   Esto comprueba la conexión y esa consulta; no valida los flujos de venta.

Si falta una variable requerida o falla la conexión, el servicio responde
HTTP 500 con un mensaje genérico, sin mostrar las credenciales ni el error de
MySQL. No se han verificado en esta revisión la ejecución de PHP ni la
integración con MySQL o con los clientes originales.

## Recursos históricos

- [Documentación de la API en Postman](https://documenter.getpostman.com/view/25380178/2s93zH2eSK)
- [Diagrama de base de datos](https://cdn.glitch.global/67cd472b-72c6-4b72-8f91-3c3387cbf446/e7ea3588-e02f-420d-8555-17f789028b8d.image.png?v=1688957755761)
- [Diccionario de datos](https://cdn.glitch.global/67cd472b-72c6-4b72-8f91-3c3387cbf446/diccionario_datos_Safey.pdf?v=1688957327179)
- [Script SQL original](https://cdn.glitch.global/67cd472b-72c6-4b72-8f91-3c3387cbf446/id20780986_proyecto_buses_das.sql?v=1688957631497)

Estos recursos corresponden al proyecto original; no sustituyen una instalación
reproducible ni pruebas del estado actual.

## Equipo y autoría

El README original identifica a Tarmijos, Yallauca, Pinchao, Naranjo y Zamora
como integrantes del equipo Safey. El historial conserva commits y merges
asociados al desarrollo. No se atribuye aquí todo el backend a una sola persona.

El repositorio no incluye una licencia de uso. Se mantiene la atribución al
equipo original; esta revisión no añade permisos de distribución o reutilización.
