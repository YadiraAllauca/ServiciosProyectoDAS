# 🚍 Safey - Sistema de Gestión de Pasajes Interprovinciales

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![REST API](https://img.shields.io/badge/REST%20API-FF6B6B?style=for-the-badge&logo=rest&logoColor=white)
![Status](https://img.shields.io/badge/Status-Activo-success?style=for-the-badge)

**Sistema backend completo para la gestión y venta de pasajes de buses interprovinciales en Ecuador**

[Características](#-características) • [Tecnologías](#-tecnologías) • [Instalación](#-instalación) • [Documentación](#-documentación) • [Contribuir](#-contribuir)

</div>

---

## 📋 Tabla de Contenidos

- [Acerca del Proyecto](#-acerca-del-proyecto)
- [Características](#-características)
- [Tecnologías](#-tecnologías)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Instalación](#-instalación)
- [Documentación](#-documentación)
- [Base de Datos](#-base-de-datos)
- [Contribuir](#-contribuir)
- [Contacto](#-contacto)
- [Licencia](#-licencia)

---

## 🎯 Acerca del Proyecto

**Safey** es un sistema integral desarrollado en PHP que proporciona servicios REST para la gestión completa de pasajes de buses interprovinciales en Ecuador. Este repositorio contiene todos los servicios backend necesarios para soportar aplicaciones móviles y web del ecosistema Safey.

### Objetivo Principal

Facilitar la gestión, búsqueda y venta de pasajes de buses interprovinciales, proporcionando una API robusta que permite:

- Búsqueda avanzada de viajes por múltiples criterios
- Gestión completa de cooperativas, buses y frecuencias
- Sistema de ventas con múltiples formas de pago
- Control de asientos y disponibilidad en tiempo real
- Gestión de usuarios y pasajeros

---

## ✨ Características

### 🔐 Autenticación y Usuarios
- Sistema de login seguro con sesiones
- Gestión de perfiles de usuarios y pasajeros
- Recuperación de contraseñas por email
- Control de acceso basado en roles (administradores, socios, pasajeros)

### 🚌 Gestión de Flota
- Registro y edición de buses con información detallada (chasis, carrocería, tipo)
- Gestión de asientos por bus
- Asignación de buses a cooperativas
- Control de viajes diarios

### 🗺️ Gestión de Rutas
- Administración de frecuencias y horarios
- Gestión de paradas (origen y destino)
- Asignación de frecuencias a cooperativas
- Búsqueda de viajes por múltiples filtros

### 🔍 Búsqueda Avanzada
- Búsqueda por origen y destino
- Filtrado por tipo de viaje
- Búsqueda por número de asiento
- Filtrado por chasis o carrocería del bus
- Búsqueda por cooperativa

### 💰 Sistema de Ventas
- Generación de ventas con múltiples formas de pago
- Generación de códigos QR para boletos
- Comprobantes de venta
- Historial de compras
- Validación de ventas

### 📊 Reportes y Consultas
- Listado de viajes disponibles
- Consulta de asientos disponibles por viaje
- Información detallada de buses
- Listado de pasajeros por viaje

---

## 🛠️ Tecnologías

| Categoría | Tecnología |
|-----------|-----------|
| **Backend** | PHP 7.4+ |
| **Base de Datos** | MySQL |
| **API** | REST API |
| **Protocolo** | HTTP/HTTPS |
| **Formato de Datos** | JSON |
| **Seguridad** | Prepared Statements, CORS |

---

## 📁 Estructura del Proyecto

```
ServiciosProyectoDAS/
│
├── 🔐 Autenticación
│   ├── login.php
│   ├── logout.php
│   ├── editarClaveUsuario.php
│   └── editarClaveUsuarioEmail.php
│
├── 👥 Gestión de Usuarios
│   ├── registroPasajero.php
│   ├── editarPerfilPasajero.php
│   ├── editarPerfilUsuario.php
│   ├── obtenerDatosUsuario.php
│   └── agregarUsuarioSocio.php
│
├── 🚌 Gestión de Buses
│   ├── agregarBus.php
│   ├── editarBus.php
│   ├── listarBuses.php
│   ├── listarBusesPorCooperativa.php
│   ├── mostrarInfoBus.php
│   └── listarViajesBus.php
│
├── 🪑 Gestión de Asientos
│   ├── agregarAsiento.php
│   ├── editarAsiento.php
│   ├── listarAsientosDisponibles.php
│   ├── listarTipoAsientos.php
│   ├── listarTipoAsientosBus.php
│   └── verificarExistenciaAsiento.php
│
├── 🏢 Gestión de Cooperativas
│   ├── agregarCooperativa.php
│   ├── editarCooperativa.php
│   ├── listarCooperativas.php
│   └── listarSociosCooperativa.php
│
├── 🗺️ Gestión de Rutas
│   ├── agregarFrecuencia.php
│   ├── editarFrecuencia.php
│   ├── listarFrecuencias.php
│   ├── agregarParada.php
│   ├── editarParada.php
│   ├── listarParadas.php
│   └── asignarFrecuenciaCooperativa.php
│
├── 🚍 Gestión de Viajes
│   ├── agregarViajeDiario.php
│   ├── editarViajeDirecto.php
│   ├── eliminarViajeDiario.php
│   ├── listarViajesDiarios.php
│   └── mostrarPasajerosViaje.php
│
├── 🔍 Búsquedas
│   ├── buscarViaje.php
│   ├── buscarVTipo.php
│   ├── buscarVAsiento.php
│   ├── buscarVChasis.php
│   ├── buscarVCarroceria.php
│   └── buscarVCoop.php
│
├── 💳 Sistema de Ventas
│   ├── generarVenta.php
│   ├── validarVenta.php
│   ├── venta_boleto.php
│   ├── ingresarDetalleVenta.php
│   ├── listarVentas.php
│   ├── listarCompras.php
│   ├── obtenerUltimaCompra.php
│   └── listarFormasPago.php
│
├── 📋 Utilidades
│   ├── listarParaFiltros.php
│   ├── listarParaVentas.php
│   ├── obtenerClavePasajero.php
│   └── eliminar.php
│
└── ⚙️ Configuración
    └── conexionBDRemota.php
```

---

## 🚀 Instalación

### Requisitos Previos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Extensiones PHP: `mysqli`, `json`, `session`

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/ServiciosProyectoDAS.git
   cd ServiciosProyectoDAS
   ```

2. **Configurar la base de datos**
   - Descargar el archivo SQL desde el [enlace de Base de Datos](#-base-de-datos)
   - Importar el archivo en tu servidor MySQL
   - Actualizar las credenciales en `conexionBDRemota.php`

3. **Configurar conexión a base de datos**
   Editar `conexionBDRemota.php` con tus credenciales:
   ```php
   $host = "localhost";
   $dbUsuario = "tu_usuario";
   $dbContraseña = "tu_contraseña";
   $dbNombre = "nombre_base_datos";
   ```

4. **Configurar el servidor web**
   - Colocar los archivos en el directorio del servidor web
   - Asegurar que PHP tenga permisos de ejecución
   - Configurar CORS si es necesario para tu dominio

5. **Verificar la instalación**
   - Acceder a un endpoint de prueba (ej: `listarFrecuencias.php`)
   - Verificar que retorne datos en formato JSON

---

## 📚 Documentación

### Documentación de la API

La documentación completa de la API está disponible en Postman:

[📖 Ver Documentación Completa de la API](https://documenter.getpostman.com/view/25380178/2s93zH2eSK)

### Endpoints Principales

#### Autenticación
- `POST /login.php` - Iniciar sesión
- `GET /logout.php` - Cerrar sesión

#### Búsqueda de Viajes
- `GET /buscarViaje.php?origen={ciudad}&destino={ciudad}` - Buscar viajes
- `GET /buscarVTipo.php` - Buscar por tipo de viaje
- `GET /buscarVAsiento.php` - Buscar por asiento

#### Gestión de Ventas
- `POST /generarVenta.php` - Crear nueva venta
- `GET /listarVentas.php` - Listar todas las ventas
- `GET /listarCompras.php` - Listar compras del usuario

#### Consultas
- `GET /listarFrecuencias.php` - Listar todas las frecuencias
- `GET /listarBuses.php` - Listar todos los buses
- `GET /listarCooperativas.php` - Listar cooperativas

---

## 🗄️ Base de Datos

### Diagrama de Base de Datos

![Diagrama de Base de Datos](https://cdn.glitch.global/67cd472b-72c6-4b72-8f91-3c3387cbf446/e7ea3588-e02f-420d-8555-17f789028b8d.image.png?v=1688957755761)

### Recursos de Base de Datos

- **Diccionario de Datos**: [📄 Descargar PDF](https://cdn.glitch.global/67cd472b-72c6-4b72-8f91-3c3387cbf446/diccionario_datos_Safey.pdf?v=1688957327179)
- **Script SQL**: [💾 Descargar Base de Datos](https://cdn.glitch.global/67cd472b-72c6-4b72-8f91-3c3387cbf446/id20780986_proyecto_buses_das.sql?v=1688957631497)

### Entidades Principales

- **Usuarios**: Gestión de usuarios del sistema
- **Cooperativas**: Información de cooperativas de transporte
- **Buses**: Registro de vehículos
- **Frecuencias**: Horarios y rutas
- **Viajes_Diarios**: Viajes programados
- **Ventas**: Transacciones de venta de pasajes
- **Asientos**: Control de disponibilidad de asientos

---

## 🤝 Contribuir

Las contribuciones son bienvenidas. Para contribuir al proyecto:

1. **Fork el proyecto**
   ```bash
   # Haz clic en el botón "Fork" en GitHub
   ```

2. **Crea una rama para tu feature**
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```

3. **Realiza tus cambios**
   - Sigue las convenciones de código existentes
   - Asegúrate de que el código funcione correctamente
   - Prueba tus cambios antes de hacer commit

4. **Commit tus cambios**
   ```bash
   git commit -m "feat: Agregar nueva funcionalidad"
   ```

5. **Push a la rama**
   ```bash
   git push origin feature/nueva-funcionalidad
   ```

6. **Abre un Pull Request**
   - Describe claramente los cambios realizados
   - Menciona cualquier issue relacionado

### Convenciones de Commit

- `feat:` Nueva funcionalidad
- `fix:` Corrección de bug
- `docs:` Cambios en documentación
- `refactor:` Refactorización de código
- `test:` Agregar o modificar tests

---

## 📧 Contacto

Para preguntas, sugerencias o colaboraciones, puedes contactar al equipo de desarrollo:

| Miembro | Email |
|---------|-------|
| **Tarmijos** | tarmijos0985@uta.edu.ec |
| **Yallauca** | yallauca3770@uta.edu.ec |
| **Pinchao** | dpinchao9519@uta.edu.ec |
| **Naranjo** | anaranjo1676@uta.edu.ec |
| **Zamora** | kzamora7938@uta.edu.ec |

---

## ©️ Licencia

Este proyecto académico no tiene una licencia específica asignada. Todos los derechos de autor pertenecen a los miembros del equipo de desarrollo. 

**Nota Legal**: No se otorgan permisos explícitos para utilizar, modificar o distribuir el código fuente o los archivos relacionados. Cualquier uso, reproducción o distribución del proyecto debe obtener permiso previo de los autores.

---

<div align="center">

**Desarrollado con ❤️ por el equipo Safey**


</div>
