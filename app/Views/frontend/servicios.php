<?= $this->extend('frontend/layout/main'); ?>

<?= $this->section('content'); ?>

<div class="container">


<div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Servicios</h1>
                <p class="lead">El Área de biblioteca cuenta con los siguientes SERVICIOS:</p>
            <ul>
                <li>Sala de lectura; cualquier material bibliográfico en formato impreso puede usarse dentro del área de
                    lectura.</li>
                <li>Préstamo a domicilio; de la colección general los libros y materiales bibliográficos son
                    susceptibles a
                    su
                    préstamo externo, únicamente a usuarios internos de la institución.</li>
                <li>Préstamo interbibliotecario; en colaboración con otras instituciones educativas de nivel superior se
                    facilita el
                    intercambio de materiales bibliográficos en calidad de préstamo reglamentado.</li>
                <li>Consulta especializada; proporciona asesoría sobre requerimientos de información especifica a
                    usuarios.
                </li>
                <li>Equipos de computo; para realización de trabajos académicos, descarga y consulta de información,
                    tanto
                    de usuarios
                    internos como externos.</li>
            </ul>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="<?php echo base_url('images/Fotodelauni.jpg'); ?>" alt="" width="720">
            </div>
        </div>
    </div>



    <div class="row align-items-md-stretch mb-5">
        <div class="col-md-6 mb-3">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                <h2>Consulta y sala de lectura</h2>
                <p>La biblioteca cuenta con 14 puestos disponibles para la realización de diversas
                    actividades educativas y de fomento a la lectura, espacio acondicionado también para el estudio en
                    grupo y la
                    investigación, abiertos a la comunidad universitaria.
                    3 equipos de computo que complementan el acceso a los recursos de información, la descarga de
                    diversos materiales de
                    consulta, elaboración de trabajos académicos, entre otros.</p>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                <h2>Servicio de Préstamo externo (a domicilio) de libros</h2>
                <p>Para hacer uso del préstamo externo, deberás contar con tu credencial de estudiante vigente y/o
                    personal de la
                    institución.
                    Las condiciones de préstamo se regulan mediante; el Reglamento de los Para servicios de biblioteca
                    de la Universidad
                    Pedagógica Nacional Unidades UPN 211, 212 y 213, en el Estado de Puebla.
                    Nota: Una vez acreditado como usuario vigente de biblioteca el Reglamento se proporciona en formato
                    digital.</p>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                <h2>Formación de Usuarios</h2>
                <p>El personal de la biblioteca proporciona la información requerida (básica y especializada) para
                    orientarte sobre la
                    información y los recursos bibliográficos que necesitas para el estudio y la investigación, así
                    mismo, el personal
                    de la biblioteca está a tu disposición para ayudarte a resolver dudas que se planten en el uso de
                    los materiales
                    bibliográficos y el de sus colecciones, puesto que la biblioteca es de estantería cerrada, el
                    usuario solicita los
                    materiales o bien solicita el acceso directamente de los materiales bibliográficos colocados en
                    estantería.</p>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                <h2>Información y referencia</h2>
                <p>La Biblioteca te proporciona información bibliográfica y respuesta a consultas generales y
                    especializadas. gracias a
                    este servicio, te ofrecemos también; localizar documentos sobre temas o autores concretos,
                    información sobre cómo
                    consultar nuestros recursos electrónicos a través de nuestra biblioteca digital.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>