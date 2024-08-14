<?= $this->extend('frontend/layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container">

    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Biblioteca Profr. Isaac Meza Vega</h1>
                <p class="lead">

                    La Biblioteca de la Universidad Pedagógica Nacional es una biblioteca especializada, es decir;
                    gestiona recursos de información principalmente para el aprendizaje, la docencia, la investigación y
                    la formación continua. Participa también en las actividades de apoyo académico y funcionamiento de
                    la Universidad.
                    Es misión de la Biblioteca la conservación, el incremento, el acceso y la difusión de los recursos
                    de información, así como la colaboración en los procesos de creación del conocimiento a fin de
                    contribuir a la consecución de los objetivos de la Universidad.</p>
                <p class="lead">El Área de Biblioteca y Apoyo Académico de nuestra Casa de Estudios, pone a su
                    disposición la presente guía ilustrativa con la finalidad de permitirle a los distintos tipos de
                    Usuarios el acceso a los recursos bibliográficos, contribuyendo así, al desarrollo de las
                    actividades académicas, propiciando la investigación mediante el uso de las colecciones
                    bibliográficas existentes, en formato impreso y digital.</p>

            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="<?php echo base_url('images/Fotodelauni.jpg'); ?>" alt="" width="720">
            </div>
        </div>
    </div>


    <div class="row align-items-md-stretch mb-5 text-light">
        <div class="col-md-6">
            <div class="h-100 p-5 rounded-3" style="background-color: #04328C;">
                <h2>Misión de</h2>
                <p>Contribuir a la formación de personas capaces de manejar los recursos de información en diferentes
                    contextos
                    educativos y laborales, proporcionando servicios competitivos y de calidad que contribuyan al
                    proceso de
                    enseñanza-aprendizaje y a la investigación con un insuperable nivel de servicio.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 border rounded-3" style="background-color: #04328C;">
                <h2>Visión</h2>
                <p>Reestructurar en forma cuantitativa y cualitativa los recursos de información con los que cuenta el
                    Área de
                    Biblioteca, para crear una cultura proyectada a la nueva era de las tecnologías de la información
                    (TI).</p>
            </div>
        </div>
    </div>

    <!-- 
    ¿Cómo accedo a los servicios del Área de Biblioteca y Apoyo Académico?
    estudiante vigente, de personal académico, administrativo y de servicios, son los documentos que identifican a los
    usuarios de
    La Credencial de;
    la Biblioteca y permiten el uso de los distintos servicios con los que se cuentan. -->

    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">¿Quién es usuario del Área de Biblioteca y Apoyo Académico?</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                Los alumnos matriculados en la Universidad, el personal docente e investigador y el personal de la
                administración y
                servicios, debidamente acreditados. También lo son todas aquellas personas expresamente autorizadas
                mediante
                acuerdos individuales o convenios institucionales realizados por la Universidad.
            </p>

        </div>
    </div>




    

    <div class="container my-5">
    <div class="p-5 bg-body-tertiary rounded-3">
        <h1>Colecciones bibliográficas</h1>
        <p>El Área de biblioteca conforma sus COLECCIONES
            BIBLIOGRAFICAS de la siguiente forma:</p>
        <ul>
            <li>Colección General; materiales bibliográficos en formato impreso, con temática especializada en
                educación, para uso
                en consulta y préstamo externo.</li>
            <li>Colección Consulta; materiales bibliográficos en formato impreso, constituido principalmente por
                diccionarios,
                enciclopedias, almanaques, entre otros, para uso únicamente en sala.</li>
            <li>Colección Libros del Rincón; materiales bibliográficos en formato impreso y de uso general en sala de
                lectura y
                préstamo externo.</li>
            <li>Colección Tesis; conformado por trabajos de tesis de licenciatura y maestría en formato impreso,
                elaborados por
                egresados de nuestra casa de estudios, su préstamo es únicamente en sala de lectura.</li>
            <li>Anexos de Antologías de programas educativos anteriores, LE, LEPEMI, Plan 90, etc.</li>
        </ul>
    </div>
    </div>


    


</div>

<?= $this->endSection(); ?>
