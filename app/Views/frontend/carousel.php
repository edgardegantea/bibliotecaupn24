<style>
    .carousel-img a {
        cursor: pointer; 
    }
</style>

<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php for ($i = 0; $i < count($images); $i++): ?>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?= $i ?>"
                class="<?= ($i == 0) ? 'active' : '' ?>" aria-current="true" 
                aria-label="Slide <?= $i + 1 ?>"></button>
        <?php endfor; ?>
    </div>

    <div class="carousel-inner">
        <?php foreach ($images as $index => $image): ?>
            <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                <?php if (!empty($image['enlace'])): ?> 
                    <a href="<?= $image['enlace']; ?>" target="_blank">
                <?php endif; ?>
                    <div class="carousel-img" style="height: 700px">
                        <img src="<?= base_url('uploads/' . $image['filename']); ?>" class="d-block"
                            alt="<?= $image['filename']; ?>">
                    </div>
                <?php if (!empty($image['enlace'])): ?>
                    </a> 
                <?php endif; ?>
                <div class="carousel-caption carousel-caption-opacity d-none d-md-block">
                    <div class="caption-background">
                        <h2 class="text-light"><?= $image['titulo']; ?></h2>
                        <p><small><?= $image['resumen']; ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
