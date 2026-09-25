# Limitaciones y trabajo pendiente

Revisión estática del repositorio realizada el 24 de septiembre de 2026.
No se ejecutaron peticiones contra el servidor original ni se utilizaron sus
credenciales. No se verificaron el esquema externo, sus restricciones o triggers,
ni controles que pudieran existir fuera de este repositorio.

## Identidad y acceso

`login.php` asigna `$_SESSION['user']` antes de comprobar las credenciales.
Solo login y logout utilizan sesiones; los demás endpoints no verifican la
identidad, el rol ni la propiedad del recurso solicitado.

`registroPasajero.php` y `agregarUsuarioSocio.php` guardan la contraseña recibida
directamente. `obtenerClavePasajero.php` la devuelve al consultar un email;
otros endpoints de perfil también incluyen `clave_usuario` en sus respuestas.
`editarClaveUsuario.php` y `editarClaveUsuarioEmail.php` actualizan contraseñas
sin comprobar la contraseña anterior, una sesión válida o un token de recuperación.

Una recuperación del proyecto requiere autenticación compartida, autorización
por operación y propietario, hashing de contraseñas y migración de las cuentas
existentes. La recuperación por email necesitaría tokens de un solo uso con
caducidad. Eliminar los campos de contraseña de las respuestas puede requerir
actualizar los clientes que hoy los consumen.

## Consultas y respuestas

Solo `login.php` utiliza una consulta preparada. Muchos otros scripts insertan
directamente parámetros GET o POST en SQL. Varias respuestas de error incluyen
la consulta y el error de MySQL. Los encabezados CORS no autentican al solicitante.

Se necesitan consultas parametrizadas, validación de entradas, respuestas de
error consistentes y comprobación de los métodos HTTP. El manejo genérico de
errores añadido en `conexionBDRemota.php` solo cubre configuración y conexión;
no sanea las respuestas de error del resto de los scripts.

## Venta y disponibilidad

`generarVenta.php` acepta el total, el comprador, el QR y el comprobante enviados
por el cliente. `ingresarDetalleVenta.php` acepta los costos del detalle.
No hay recálculo de precios a partir de tarifas del servidor.

La cabecera y los detalles se insertan en peticiones independientes. No hay
transacciones ni bloqueos en los scripts que garanticen la atomicidad de la
compra o la exclusividad de una reserva. Sin revisar el esquema no se puede
determinar qué restricciones adicionales aplica MySQL.

`listarAsientosDisponibles.php` filtra `Asientos` por bus, descripción y estado;
no recibe un viaje ni consulta sus ventas. La disponibilidad de un asiento
debería definirse por viaje y, si se permite vender tramos, por los segmentos
ocupados entre paradas. Esa regla debe acordarse antes de cambiar el modelo.

Antes de considerar estos flujos utilizables se deberían probar, al menos:

- Dos compradores intentando reservar el mismo asiento y viaje simultáneamente.
- Reintento de una compra tras perder la respuesta, sin duplicar la venta.
- Fallo al insertar un detalle, sin dejar una compra parcialmente creada.
- Manipulación de precios, comprador o estado desde el cliente.
- Acceso a compras ajenas y operaciones de administración sin permiso.

## Configuración y credenciales históricas

La conexión ahora lee `DB_HOST`, `DB_USER`, `DB_PASSWORD` y `DB_NAME` del entorno.
`.env.example` contiene únicamente valores de ejemplo y `.env` está ignorado.

Antes de esta revisión había credenciales literales en un archivo versionado.
Sustituirlas en la versión actual **no las elimina del historial Git**. Si siguen
vigentes, el responsable de la base debe rotarlas. No se comprobó su validez,
no se accedió a la base y no se reescribió el historial.

## Alcance de esta revisión

Se conserva el proyecto como antecedente académico con su autoría de equipo.
Se corrigió su presentación y se retiraron las credenciales del archivo de
conexión actual. Los problemas de autenticación, SQL y ventas descritos arriba
siguen pendientes; no se presenta esta revisión como una reparación de seguridad
del backend completo.

No hay tests automatizados ni CI en el repositorio. El entorno de revisión no
tiene PHP disponible, por lo que no se ejecutaron lint PHP ni pruebas de
integración. Para recuperar el backend harían falta el esquema versionado sin
datos reales, fixtures y pruebas de los contratos con los clientes.
