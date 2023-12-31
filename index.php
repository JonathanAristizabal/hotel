<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paradise Hotel & Resort</title>
    <link rel="shortcut icon" href="icon-ordenador.png" type="image/x-icon" />
    <link rel="stylesheet" href="./assets/css/styles.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Noto+Serif&family=Poppins&display=swap" rel="stylesheet">

  </head>
  <body>
    <header>
      <nav>
        <a href="#">Inicio</a>
        <a href="./pages/reservas_usuario.php">Reservas</a>
        <a href="#">Habitaciones</a>
        <a href="#">Servicios</a>
        <a href="#">Contacto</a>
      </nav>
      <section class="textos-header">
        <h1 class="titulo1">Paradise Hotel & Resort</h1>
        <h2 class="subtitulo1">"Creando momentos excepcionales."</h2>
      </section>
      <div class="wave" style="height: 150px; overflow: hidden">
        <svg
          viewBox="0 0 500 150"
          preserveAspectRatio="none"
          style="height: 100%; width: 100%"
        >
          <path
            d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
            style="stroke: none; fill: #fff"
          ></path>
        </svg>
      </div>
    </header>
    <main>
      <section class="contenedor sobre-nosotros">
        <h2 class="titulo2">Disfruta nuestros servicios</h2>
        <div class="contenedor-sobre-nosotros">
          <img src="./assets/img/playa.jpg" alt="Playa paradisiaca" class="imagen-about-us"/>
          <div class="contenido-textos">
            <h3><span>1</span>Habitaciones de ensueño</h3>
            <p>
              Nuestras habitaciones están diseñadas para brindarte el máximo
              confort y lujo. Disfruta de vistas impresionantes al océano y
              todas las comodidades que necesitas para relajarte.
            </p>
            <h3><span>2</span>Cocina gourmet</h3>
            <p>
              En nuestro restaurante, te espera una experiencia culinaria
              excepcional. Nuestros chefs expertos preparan platos exquisitos
              con ingredientes frescos y locales.
            </p>
            <h3><span>3</span>Cocina gourmet</h3>
            <p>
              En nuestro restaurante, te espera una experiencia culinaria
              excepcional. Nuestros chefs expertos preparan platos exquisitos
              con ingredientes frescos y locales.
            </p>
          </div>
        </div>
      </section>
      <section class="portafolio">
        <div class="contenedor">
          <h2 class="titulo">Galería de Fotos</h2>
          <br>
          <div class="galeria-port">
            <div class="imagen-port">
              <img src="./assets/img/suite.jpg" alt="Piscina del hotel" />
              <div class="hover-galeria">
                <img src="./assets/img/icon1.png" alt="Icono de estrella" />
                <p>Suite uno</p>
              </div>
            </div>
            <div class="imagen-port">
              <img src="./assets/img/suite1.jpg" alt="Spa del hotel" />
              <div class="hover-galeria">
                <img src="./assets/img/icon1.png" alt="Icono de estrella" />
                <p>Suite dos</p>
              </div>
            </div>
            <div class="imagen-port">
              <img src="./assets/img/suite2.jpg" alt="Spa del hotel" />
              <div class="hover-galeria">
                <img src="./assets/img/icon1.png" alt="Icono de estrella" />
                <p>Habitacion sencilla</p>
              </div>
            </div>
            <div class="imagen-port">
              <img src="./assets/img/suite3.jpg" alt="Spa del hotel" />
              <div class="hover-galeria">
                <img src="./assets/img/icon1.png" alt="Icono de estrella" />
                <p>Habitacion doble</p>
              </div>
            </div>
            
            
            <!-- Agrega más imágenes de la galería -->
          </div>
        </div>
      </section>
      <section class="clientes contenedor">
        <h2 class="titulo">Opiniones de Nuestros Clientes</h2>
        <br>
        <div class="cards">
          <div class="card">
            <img src="./assets/img/cliente1.jpg" alt="Foto de un cliente" />
            <div class="contenido-texto-card">
              <h4>Maria González</h4>
              <p>
                "Mi estancia en Paradise Hotel & Resort fue inolvidable. El
                servicio y la ubicación son espectaculares. Definitivamente
                regresaré."
              </p>
            </div>
          </div>
          <div class="card">
            <img src="./assets/img/cliente2.jpg" alt="Foto de un cliente" />
            <div class="contenido-texto-card">
              <h4>Juan Pérez</h4>
              <p>
                "El personal del hotel es amable y siempre dispuesto a ayudar.
                Las habitaciones son espaciosas y cómodas. ¡Una experiencia de
                cinco estrellas!"
              </p>
            </div>
          </div>
          <!-- Agrega más opiniones de clientes -->
        </div>
      </section>
      <section class="about-services">
        <div class="contenedor">
          <h2 class="titulo">Nuestros Servicios</h2>
          <br>
          <div class="servicio-cont">
            <div class="servicio-ind">
              <img src="./assets/img/spa.jpg" alt="Icono de spa" />
              <h3>Spa de Lujo</h3>
              <p>
                Relájate y rejuvenece en nuestro spa de clase mundial con
                tratamientos exclusivos y terapeutas expertos.
              </p>
            </div>
            <div class="servicio-ind">
              <img src="./assets/img/restaurante.jpg" alt="Icono de restaurante" />
              <h3>Gastronomía Exquisita</h3>
              <p>
                Disfruta de platos gourmet en nuestro restaurante, donde los
                ingredientes frescos son la clave de cada creación culinaria.
              </p>
            </div>
            <div class="servicio-ind">
              <img src="./assets/img/actividades.jpg" alt="Icono de actividades" />
              <h3>Actividades Variadas</h3>
              <p>
                Ofrecemos una variedad de actividades, taller de relajacion, deportes acuáticos
                hasta excursiones locales, para hacer que tu estadía sea
                memorable.
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
    <footer>
      <div class="contenedor-footer">
        <div class="content-foo">
          <h4>Teléfono</h4>
          <p>+57 3178542709</p>
        </div>
        <div class="content-foo">
          <h4>Email</h4>
          <p>contacto@paradisehotel.com</p>
        </div>
        <div class="content-foo">
          <h4>Panel Administrativo</h4>
          <a href="./pages/home_panel.php">Link</a>
        </div>
      </div>
    </footer>
  </body>
</html>
