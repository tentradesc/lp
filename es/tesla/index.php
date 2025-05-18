<?php 

   $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : '';
   $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : '';
   $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : '';
   $utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : '';
   $utm_term = isset($_GET['utm_term']) ? $_GET['utm_term'] : '';
?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel=" icon" href="assets/favicon.ico">
      <title>Oferta exclusiva de Tesla para Traders de Latinoamérica</title>
      <link rel="stylesheet" href="assets/style.css?6">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
         <!-- Google Tag Manager -->
         <script>(function (w, d, s, l, i) {
         w[l] = w[l] || []; w[l].push({
            'gtm.start':
               new Date().getTime(), event: 'gtm.js'
         }); var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
               'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-N6N8FW26');</script>
      <!-- End Google Tag Manager -->
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments)};
         gtag('js', new Date());
         gtag('config', 'GTM-ND9QKSP2');
      </script>
   </head>
   <body>

      <style>
         .btn-warning {
            color: #212529;
            background-color: transparent;
            border-color: transparent;
         }

         .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            min-height: 1px;
            padding: 0rem;
         }

         .card {

            border: 0px solid rgba(0, 0, 0, .125);

         }

         #loading-spinner {
            text-align: center;
         }

         #loading-spinner2 {
            text-align: center;
         }

         .spinner {
            margin: 20px auto;
            width: 70px;
            text-align: center;
         }

         .spinner>div {
            width: 18px;
            height: 18px;
            background-color: #313131;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: bounce 1.4s infinite ease-in-out;
            animation: bounce 1.4s infinite ease-in-out;
         }

         .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
         }

         .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
         }

         @-webkit-keyframes bounce {

            0%,
            80%,
            100% {
               -webkit-transform: scale(0);
            }

            40% {
               -webkit-transform: scale(1);
            }
         }

         @keyframes bounce {

            0%,
            80%,
            100% {
               transform: scale(0);
            }

            40% {
               transform: scale(1);
            }
         }



         /* CSS for the spinner */
         .spinner2 {
            border: 4px solid rgba(0, 0, 0, 0.2);
            /* Clear border */
            border-top: 4px solid #007bff;
            /* Change the color to your preference */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.6);
            /* Clear background */
            z-index: 9999;
            /* Ensure it's on top of other content */
         }

         /* Keyframes for the spinner animation */
         @keyframes spin {
            0% {
               transform: rotate(0deg);
            }

            100% {
               transform: rotate(360deg);
            }
         }

         /* CSS to hide the spinner when the page is loaded */
         .loaded .spinner2 {
            display: none;
         }
      </style>
      <script>
         $(document).ready(function () {
            $.ajax({
               url: 'https://tentrade.com/restfulservice/v1/get-location.php/',
               method: 'GET',
               success: function(response) {
                     if (response.status) {
                        const location = response.data;

                        // Example: auto-fill a country input field
                        $('#country').val(location.countryCode || 'MX');
                        $('#city').val(location.city || 'MX');
                     } else {
                        console.warn('Failed to get location:', response.message);
                     }
               },
               error: function(xhr, status, error) {
                     console.error('AJAX error:', error);
               }
            });
         });
      </script>
      <script>
         jQuery(function ($) {
            $('#formsubmit').submit(function (event) {
               // Prevent the default form submission
               event.preventDefault();

               // Store original phone value and prepend dial code
               var originalPhone = $('#phone').val().trim();
               var dialCode = $('.selected-dial-code').text().trim();
               $('#phone').val(dialCode + originalPhone);

               $('#success-message').hide();

               // Show spinner loader
               $('#loading-spinner').show();

               // Serialize form data
               var formData = $(this).serialize();

               // alert(formData);

               //  return;

               // AJAX post request
               $.post({
                  url: 'https://tentrade.com/restfulservice/v1/create-client.php',
                  data: formData,
                  success: function (response) {
                     // Hide spinner loader
                     $('#loading-spinner').hide();

                     var status = response.status;

                     if (status == 1) {

                        $('#error-message').hide();
                        $('#success-message').text("Registration successful").show();

                        dataLayer.push({
                           'event': 'generate_lead',
                           'userData': {
                              'sha256_email_address': response.data.sha256_email_address,
                              'sha256_phone_number': response.data.sha256_phone_number,
                           }
                        });

                     } else {

                        $('#success-message').hide();

                        /*
                        if(response.data.errors && Array.isArray(response.data.errors)) {

                           var errorMessages = response.data.errors.map(function (error) {
                              return error.message || 'Unknown error';
                           });

                           $('#error-message').html(errorMessages.join('<br>')).show();

                        } else {

                           $('#error-message').text('Unknown Error').show();

                        }
                        */

                     }

                  },
                  error: function (xhr, status, error) {
                     // Hide spinner loader
                     $('#loading-spinner').hide();

                     var arr = xhr.responseJSON.data.errors;
                     var message = '';

                     var errorMessages = $.map(arr, function(n) {
                        return n.message;
                     });

                     var finalMessage = errorMessages.length === 1
                        ? errorMessages[0]
                        : errorMessages.join(', ');

                     
                     $('#error-message').text(finalMessage).show();


                  }

               });
            });
         });
      </script>



      <style>
         #loader {
            display: none;
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 20px;
            height: 20px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
            position: absolute;
            margin-top: -35px;
            margin-left: 0px;
         }

         @-webkit-keyframes spin {
            0% {
               -webkit-transform: rotate(0deg);
            }

            100% {
               -webkit-transform: rotate(360deg);
            }
         }

         @keyframes spin {
            0% {
               transform: rotate(0deg);
            }

            100% {
               transform: rotate(360deg);
            }
         }

         #error-message,
         #success-message {
            display: none;
            color: red;
            margin-top: 10px;
            font-size: 14px;
         }

         #success-message {
            color: green;
         }


         #error-message2,
         #success-message2 {
            display: none;
            color: red;
            margin-top: 10px;
            font-size: 14px;
         }

         #success-message2 {
            color: green;
         }

         #country {
            display: none;
         }
      </style>

      
         <section class="header-section">
            <div class="container-fluid">
               <div class="page-content">
                  <div class="header">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-lg-6 col-md-6">
                              <div class="logo-img">
                                 <a href="#">
                                     <img src="assets/logo-wh.png?11" alt="logo" class="img_logo">
                                 </a>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="hero-section">
                     <div class="container-fluid banner_section_content">
                        <div class="row align-items-center">
                           <div class="col-lg-6 text-center">
                              <!-- <div class="loader">
                                 <span>T</span>
                                 <span>E</span>
                                 <span>S</span>
                                 <span>L</span>
                                 <span>A</span>
                              </div> -->
                              <img src="assets/Tesla-Logo.png" alt="Tesla"  class="icon-img d-none d-lg-block mb-5">
                              <img src="assets/Telsa.png" alt="Tesla"  class="icon-img d-none d-lg-block">
                           </div>
                           <div class="col-lg-6">
                              <h1 class="head-title text-white"> Oferta exclusiva de Tesla para Traders de Latinoamérica 100% de Bonificación <a class="cursor_point" onclick="openPopup()"> (?) </a> + 20% de Reembolso <a class="cursor_point" onclick="openPopupp()">(?)</a> </h1>
                              <p class="heroSbHead text-white">Regístrate en menos de 3 minutos y comienza a operar con una plataforma regulada.</p>
                              <!-- Form Section -->
                              <section>
                                 <div class="form-container">
                                    <!-- <div class="logo-container">
                                       <img src="assets/invsting.png" alt="Logo" class="logo">
                                       </div> -->
                                       <form id="formsubmit" method="POST" class="formLead form-horizontal registration-form">
                                          <div class="alert alert-danger" role="alert" id="error-message"></div>
                                          <!-- Error message -->
                                          <div class="alert alert-success" role="alert" id="success-message"></div>
                                          <!-- Success message -->
   
                                          <div class="row">
   
                                             <div style="width: 50% !important;" class="input-group col-lg-12">
                                                <input name="first_name" type="text" class="form-control" placeholder="Nombre"
                                                   required>
                                             </div>
                                             <div style="width: 50% !important;" class="input-group col-lg-12">
                                                <input name="last_name" type="text" class="form-control"
                                                   placeholder="Apellido" required>
                                             </div>
   
   
                                             <div class="input-group col-lg-12">
                                                <input type="tel" name="phone" id="phone" class="form-control"
                                                   placeholder="Teléfono" required>
   
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="input-group col-lg-12">
                                                <input name="email" type="email" class="form-control" placeholder="Email">
                                                <input type="hidden" id="utm_source" name="utm_source" value="<?php echo htmlspecialchars($utm_source) ?>" />
                                          <input type="hidden" id="utm_campaign" name="utm_campaign" value="<?php echo htmlspecialchars($utm_campaign) ?>" />
                                          <input type="hidden" id="utm_medium" name="utm_medium" value="<?php echo htmlspecialchars($utm_medium) ?>" />
                                          <input type="hidden" id="utm_content" name="utm_content" value="<?php echo htmlspecialchars($utm_content) ?>" />
                                          <input type="hidden" id="utm_term" name="utm_term" value="<?php echo htmlspecialchars($utm_term) ?>" />
                                          <input type="hidden" id="lead" name="lead" class="form-control1" value="false" />
                                          <input type="hidden" id="lang" name="lang" class="form-control1" value="es" />
                                          <input type="hidden" id="country" name="country" class="form-control1" value="" />
                                          <input type="hidden" id="city" name="city" class="form-control1" value="" />
                                             </div>
                                          </div>
                                          <span class="form_checkbox">
                                             <input type="checkbox" id="vehicle1" name="vehicle1" value="">
                                             <label for="vehicle1">Confirma que tiene 18 años de edad o más y reconoce que ha
                                                leído nuestros
                                                <a href="https://cabinet.10tradefx.com/uploads/public/company-documents/2025/02/10/c7db949f13949e59025ad01c61076749.pdf?utm_source=investing&utm_medium=lp&utm_campaign=investing-lp"
                                                   target="_blank" class="underline">Términos y Condiciones </a>
                                             </label>
                                          </span>
   
                                          <div id="loading-spinner"
                                             style="display: none;text-align: center;    margin-top: -56px !important;    margin-bottom: 60px;">
                                             <div class="spinner">
                                                <div class="bounce1"></div>
                                                <div class="bounce2"></div>
                                                <div class="bounce3"></div>
                                             </div>
                                          </div>
   
                                          <button type="submit" id="submit-button" class="submit-button" disabled>Regístrate y
                                             empieza a operar</button>
                                          <span class="form_span mt-2">
                                             <b>🎁 Maximice sus recompensas: ¡comercie, gane y desbloquee beneficios VIP con
                                                TenTrade!</b>
                                          </span>
                                       </form>
                                 </div>
                              </section>
                              <img src="assets/Tesla-Logo.png" alt="Tesla"  class="icon-img d-block d-lg-none mb-3 mt-3">
                              <img src="assets/Telsa.png" alt="Tesla"  class="icon-img d-block d-lg-none">
                              <!-- Form Section End -->
                           </div>
                        </div>
                     </div>
                  </div>
                  <p class="text-center motion_money mb-5">
                  Compre 200 acciones de Tesla hoy y obtenga una posible ganancia de <b>$36,400</b> antes de fin de año
               </p>

               </div>
            </div>
         </section>
      
      <!-- header-section End-->
      <!-- Why Choose Section -->
      <section class="whyChoose-section_main">
         <div class="container-fluid">
            <div class="whyChoose-section text-center mb-5 text-white">
               <h2>
                  ¿Por qué invertir en Tesla?
               </h2>
               <p class="text-white">
                  No pierdas la oportunidad de invertir en una de las acciones más innovadoras y prometedoras del mercado.

               </p>
            </div>
            <div class="container">
               <div class="row gy-5">
                  <div class="col-lg-6">
                     <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold ">Liderazgo en movilidad eléctrica</h4>
                           <p class="text-white">Tesla está revolucionando la industria automotriz con su tecnología de vehículos eléctricos, superando constantemente a la competencia.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold ">Crecimiento y rentabilidad a largo plazo</h4>
                           <p class="text-white">Con un historial de expansión y altos márgenes de beneficio, Tesla sigue siendo una de las acciones con mayor potencial de crecimiento.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 mt-4">
                     <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold "> Innovación en múltiples sectores</h4>
                           <p class="text-white">Más allá de los automóviles, Tesla invierte en energía renovable, inteligencia artificial y robótica, diversificando sus fuentes de ingresos.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 mt-4">
                     <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold ">Sostenibilidad y el futuro de la energía</h4>
                           <p class="text-white">Apostar por Tesla significa invertir en un futuro más limpio y sostenible, con soluciones que están transformando la forma en que el mundo consume energía.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="cta-btn text-center">
                     <a href="#form_site" class="call-btn1 btn">
                     Empieza a Operar
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="new_box">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <h2 class="py-4">
                     Cómo invertir en Tesla de forma fácil, rápida y segura
                  </h2>
                  <!-- <p class="mb-5">
                     Dalle nozioni di base alle strategie avanzate, eToro offre funzionalità uniche che portano il tuo portafoglio al livello successivo
                     </p> -->
                  <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                     <div class="circle circle-01 text-white mr-3">
                        01
                     </div>
                     <div>
                        <h3 class="h5 font-weight-bold">
                           Crea Su cuenta
                        </h3>
                        <p>
                          Regístrese y cree una cuenta.
                        </p>
                     </div>
                  </div>
                  <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                     <div class="circle circle-02 text-white mr-3">
                        02
                     </div>
                     <div>
                        <h3 class="h5 font-weight-bold">
                           Verificar
                        </h3>
                        <p>
                           Confirme su identidad verificándola con uno de nuestros socios de confianza.
                        </p>
                     </div>
                  </div>
                  <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                     <div class="circle circle-03 text-white mr-3">
                        03
                     </div>
                     <div>
                        <h3 class="h5 font-weight-bold">
                           Depósito
                        </h3>
                        <p>
                           Deposite fondos de forma segura a través de nuestras opciones admitidas.
                        </p>
                     </div>
                  </div>
                  <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                     <div class="circle circle-04 text-white mr-3">
                        04
                     </div>
                     <div>
                        <h3 class="h5 font-weight-bold">
                           Empieza a invertir en Tesla
                        </h3>
                        <p>¡Todo está listo! Empiece a invertir en Nvidia . Acceda a más de 3,000 activos digitales
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 d-flex justify-content-center align-items-center">
                  <img alt="Smartphone displaying investment app interface" class="img-fluid new_img w-100" src="assets/web-two.png"/>
               </div>
               <div class="cta-btn1 text-center">
                  <a href="#" class="call-btn1 btn">
                  Empieza a Operar
                  </a>
               </div>
            </div>
         </div>
      </section>
       <section class="whyChoose-section_main">
         <div class="container-fluid">
            <div class="whyChoose-section text-center mb-5 text-white">
               <h2>
                  Por qué los comerciantes eligen TenTrade
               </h2>
               <p class="text-white">Únase a millones de comerciantes que confían en nosotros para obtener escalamiento flexible, pagos ultrarrápidos y soporte.
               </p>
            </div>
            <div class="container">
               <div class="row gy-5">
                  <div class="col-lg-6">
                     <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold ">Seguridad de los fondos <i class="fa-solid fa-shield-halved"></i></h4>
                           <p class="text-white">TenTrade se compromete a proteger sus intereses gracias a nuestras
                              sólidas medidas de seguridad financiera.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold ">Soporte personalizado <i class="fa-solid fa-headset"></i></h4>
                           <p class="text-white">Nuestro equipo de soporte especializado está aquí para brindarle
                              orientación experta y asistencia personalizada siempre que la necesite.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 mt-4">
                     <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold ">Pagos rápidos <i class="fa-solid fa-money-bill-1-wave"></i></h4>
                           <p class="text-white">Es un proceso de retiro rápido y confiable. Sin demoras ni
                              problemas: ¡solo pagos
                              seguros y sin complicaciones cuando los necesite!
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 mt-4">
                     <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                           <h4 class="text-gold ">Herramientas de trading <i class="fa-solid fa-screwdriver-wrench"></i></h4>
                           <p class="text-white">Maximice su estrategia, analice los mercados en tiempo real y
                              opere de manera más inteligente con nuestra innovadora plataforma MT5.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="cta-btn text-center">
                     <a href="#form_site" class="call-btn1 btn">
                     Empieza a Operar
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="new_box">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <h2 class="py-4 text-center">
                     Comience a operar con las acciones más populares de la actualidad. ¡Descubra oportunidades de mercado ahora!
                  </h2>
                  <!-- <p class="mb-5">
                     Dalle nozioni di base alle strategie avanzate, eToro offre funzionalità uniche che portano il tuo portafoglio al livello successivo
                     </p> -->
                  <div class="tab">
                     <button class="tablinks active" onclick="openCity(event, 'London')">Acciones populares</button>
                     <button class="tablinks" onclick="openCity(event, 'Paris')">Tecnología</button>
                     <button class="tablinks" onclick="openCity(event, 'Tokyo')">Bienes duraderos</button>
                     <button class="tablinks" onclick="openCity(event, 'kothada')">De consumo</button>
                  </div>
                  <div id="London" class="tabcontent">
                     <div class="in_flex">
                        <div class="tab_img">
                           <img class="w-100" src="assets/tab1.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/tab2.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/tab3.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/tab4.JPG">
                        </div>
                     </div>
                  </div>
                  <div id="Paris" class="tabcontent">
                     <div class="in_flex">
                        <div class="tab_img">
                           <img class="w-100" src="assets/2tab1.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/2tab2.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/2tab3.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/2tab4.JPG">
                        </div>
                     </div>
                  </div>
                  <div id="Tokyo" class="tabcontent">
                     <div class="in_flex">
                        <div class="tab_img">
                           <img class="w-100" src="assets/3tab1.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/3tab2.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/3tab3.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/3tab4.JPG">
                        </div>
                     </div>
                  </div>
                  <div id="kothada" class="tabcontent">
                     <div class="in_flex">
                        <div class="tab_img">
                           <img class="w-100" src="assets/4tab1.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/4tab2.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/4tab3.JPG">
                        </div>
                        <div class="tab_img">
                           <img class="w-100" src="assets/4tab4.JPG">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="cta-btn1 text-center">
                  <a href="#" class="call-btn1 btn">
                  Empieza a Operar
                  </a>
               </div>
            </div>
         </div>
      </section>

      <section class="slider-section linear">
         <div class="container">
            <div class="py-5">
               <h2 class="text-center section-title text-capitalize py-3 mt-5 mb-5 TrustBox_heading text-dark"> Descubra por qué los traders nos aman</h2>
               <div class="reviews-box">
                  <div class="row mb-5 align-items-center">
                     <div class="col-lg-12">
                        <div class="trust-pilot-logo text-center text-white">
                           <!-- TrustBox widget - Mini -->
                           <div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8807dec7e10d38f59f32" data-businessunit-id="64d53ebbd0dabd9ec6b44ef8" data-style-height="150px" data-style-width="100%">
                              <a href="https://www.trustpilot.com/review/tentrade.com" target="_blank" rel="noopener">Trustpilot</a>
                           </div>
                           <!-- End TrustBox widget -->
                        </div>
                     </div>
                    
                  </div>
               </div>
            </div>
         </div>
         </div>
         </div>
      </section>
      <footer class="pt-5 pb-5">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6 footer-text">
                  <a href="#"> <img src="assets/logo-wh.png"></a>
               </div>
               <div class="col-lg-6 footer-text">
                  <ul class="social-link">
                     <li>
                        <a href="https://www.facebook.com/tentrade.es/">
                        <img src="assets/fb.png">
                        </a>
                     </li>
                     <li>
                        <a href="https://www.linkedin.com/company/tentrade-es">
                        <img src="assets/linkedin.png">
                        </a>
                     </li>
                     <li>
                        <a href="https://www.instagram.com/tentradeespanol/">
                        <img src="assets/inst.png">
                        </a>
                     </li>
                     <li>
                        <a href="https://x.com/Tentradees">
                        <img src="assets/twit.png">
                        </a>
                     </li>
                     <li>
                        <a href="https://www.youtube.com/@tentradeglobal">
                        <img src="assets/yt.png">
                        </a>
                     </li>
                     <li>
                        <a href="https://t.me/TenTradeGlobal">
                        <img src="assets/telegram.png">
                        </a>
                     </li>
                     <li>
                        <a href="https://www.tiktok.com/@tentrade.global">
                        <img src="assets/tiktok.png">
                        </a>
                     </li>
                     <li>
                        <a href="https://discord.com/invite/YVwM9SPGBQ">
                        <img src="assets/discord.png">
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <hr>
            <p class="">
               ADVERTENCIA DE RIESGO “Contrato por Diferencias” (CFDs) son productos generalmente apalancados. Operar
               con CFDs en el mercado extrabursátil (OTC) relacionados con commodities, Forex, índices y acciones,
               conlleva un alto nivel de riesgo y puede resultar en la pérdida total de su inversión. Por lo tanto, los
               CFDs pueden no ser apropiados y/o adecuados para todos los inversores. No debe invertir dinero que no
               pueda permitirse perder. Antes de decidir operar, debe estar consciente de todos los riesgos asociados
               con el comercio de CFDs OTC y buscar el asesoramiento de un asesor financiero independiente y
               adecuadamente autorizado. El rendimiento pasado no constituye un indicador fiable de los resultados
               futuros. Las previsiones futuras no constituyen un indicador fiable del rendimiento futuro. La
               información general y/o las recomendaciones proporcionadas por la Empresa no deben interpretarse como
               asesoramiento de inversión. Para más información, visite nuestra Política de Divulgación General de
               Riesgos.
            </p>
            <p class="  ">
               Descargo de responsabilidad: La información en este sitio no está dirigida a residentes en ningún país o
               jurisdicción donde dicha distribución o uso sea contraria a la ley o regulación local.
            </p>
            <p class=" mb-0">
               TenTrade es un nombre comercial de Evalanch Ltd (en adelante, la “Compañía”), que está licenciada y
               regulada por la Autoridad de Servicios Financieros de Seychelles con el número de licencia SD082.
            </p>
            <p>
               Evalanch Ltd, con número de registro 8429760-1, tiene su oficina registrada en CT House, Oficina 9A,
               Providence, Mahe, Seychelles
            </p>
            <hr>
            <div class="row">
               <div class="col-lg-6 footer-text">
                  <p class="m-0">
                     <img src="assets/logo-foot.png"> Copyright ©
                     <script>
                        document.write(new Date().getFullYear())
                     </script> TenTrade. Todos los derechos reservados.
               </div>
               <div class="col-lg-6 footer-text">
                  <p class="legal"><a href="https://cabinet.10tradefx.com/uploads/public/company-documents/2025/02/10/c7db949f13949e59025ad01c61076749.pdf?utm_source=investing&utm_medium=lp&utm_campaign=investing-lp"
                     target="_blank">Términos y condiciones </a> | <a
                     href="https://tentrade.com/en/company-policies-6/?utm_source=investing&utm_medium=langing-page-es&utm_campaign=trade-investing-lp-es"
                     target="_blank">Documentos Legales </a> | <a
                     href="https://tentrade.com/en/contact-us-5/?utm_source=investing&utm_medium=lp&utm_campaign=investing-lp"
                     target="_blank">Contacta con nosotros</a></p>
               </div>
            </div>
            </p>
         </div>
      </footer>
      <!-- Footer End -->
      <script>
         const checkbox = document.getElementById("vehicle1");
         const submitButton = document.getElementById("submit-button");
         
         checkbox.addEventListener("change", function () {
             if (checkbox.checked) {
                 submitButton.disabled = false; // Enable the button
             } else {
                 submitButton.disabled = true; // Disable the button
             }
         });
      </script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.16/css/intlTelInput.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.16/js/intlTelInput.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.16/js/utils.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
       
         jQuery("#carousel3").owlCarousel({
                autoplay: true,
                nav:true,
                loop: true, 
                margin: 20,
                responsiveClass: true,
                autoHeight: true,
                autoplayTimeout: 10000,
                smartSpeed: 800,
                dots: false,
                responsive: {
                  0: {
                    items: 1
                  },
              
                  600: {
                    items: 1
                  },
              
                  1024: {
                    items: 3
                  },
              
                  1366: {
                    items: 3
                  }
                }
              });  
              $('.moreless-button').click(function () {
              $('.moretext').slideToggle();
              
              if ($(this).text().trim() === "Read more") {
              $(this).text("Read less");
              } else {
              $(this).text("Read more");
              }
              });
      </script>
      <style type="text/css">
         form h3 
         {
         font-size: 20px;
         text-align: center;
         }
         .separate-dial-code{
         width: 100%
         }
      </style>
      <script>
         function openCity(evt, cityName) {
           var i, tabcontent, tablinks;
           tabcontent = document.getElementsByClassName("tabcontent");
           for (i = 0; i < tabcontent.length; i++) {
             tabcontent[i].style.display = "none";
           }
           tablinks = document.getElementsByClassName("tablinks");
           for (i = 0; i < tablinks.length; i++) {
             tablinks[i].className = tablinks[i].className.replace(" active", "");
           }
           document.getElementById(cityName).style.display = "block";
           evt.currentTarget.className += " active";
         }
      </script>


      <!-- Popup Modal -->
<div class="popup" id="popupModal">
  <div class="popup-content">
    <p>Bono acreditado en el primer depósito. Se aplican términos y condiciones.</p>
    <button class="close-btn" onclick="closePopup()">Cerrar</button>
  </div>
</div>

<script>
  // Function to open the popup
  function openPopup() {
    document.getElementById('popupModal').style.display = 'flex';
  }

  // Function to close the popup
  function closePopup() {
    document.getElementById('popupModal').style.display = 'none';
  }
</script>



      <!-- Popup Modal -->
<div class="popupp" id="popupModall">
  <div class="popup-contentt">
    <p>Reembolso acreditado a final de mes sobre pérdidas netas</p>
    <button class="close-btnn" onclick="closePopupp()">Cerrar</button>
  </div>
</div>

<script>
  // Function to open the popup
  function openPopupp() {
    document.getElementById('popupModall').style.display = 'flex';
  }

  // Function to close the popup
  function closePopupp() {
    document.getElementById('popupModall').style.display = 'none';
  }
</script>

<style>
  /* Popup Modal Styles */
  .popup {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 999;
  }
  .popup-content {
    background: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
  }
  .close-btn {
    margin-top: 10px;
    padding: 5px 10px;
    background: #e31937;
    color: white;
    border: none;
    cursor: pointer;
  }

  .popupp {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 999;
  }
  .popup-contentt {
    background: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
  }
  .close-btnn {
    margin-top: 10px;
    padding: 5px 10px;
    background: #e31937;
    color: white;
    border: none;
    cursor: pointer;
  }
  .cursor_point{
   cursor: pointer;
  }
  .icon-img {
  width: 100%;
  max-width: 600px;
}
</style>
   </body>
</html>
