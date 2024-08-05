<?= $this->extend('frontend/layout/main'); ?>

<?= $this->section('content'); ?>

<?= $this->include('frontend/carousel'); ?>


<div class="container my-5 align-items-center">
    <img class="img-fluid" src="<?php echo base_url('images/BannerOriginal6.jpg'); ?>" alt="">
</div>


<?= $this->include('frontend/buscador'); ?>

<div class="container marketing">

    <!-- Three columns of text below the carousel -->

    <!--
    <div class="row">
        <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
            </svg>
            <h2 class="fw-normal">Heading</h2>
            <p>Some representative placeholder content for the three columns of text below the carousel. This is
                the first column.</p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
            </svg>
            <h2 class="fw-normal">Heading</h2>
            <p>Another exciting bit of representative placeholder content. This time, we've moved on to the
                second column.</p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
            </svg>
            <h2 class="fw-normal">Heading</h2>
            <p>And lastly this, the third column of representative placeholder content.</p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
        </div>
        
    </div> -->

</div>

<?= $this->include('frontend/recinfo'); ?>

<?= $this->endSection(); ?>