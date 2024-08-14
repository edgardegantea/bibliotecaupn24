<div class="my-5">
    <div class="p-5" style="background-color: #04328C;">
        <div class="container text-center align-item-center">
            <h2 class="pb-2 text-light border-bottom">Buscadores bibliográficos</h2>

            <div class="row row-cols-1 row-cols-lg-5 align-items-stretch g-2 py-2">
                <?php foreach ($bblio as $index => $rb): ?>

                    <div class="col">
                        <!-- <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-3 shadow-lg" style="background-image: url('<?= base_url('uploads/' . $rb['filename']); ?>');"> -->
                        <?php if (!empty($rb['enlace'])): ?>
                        <a href="<?= $rb['enlace']; ?>" target="_blank" class="text-decoration-none">
                            <?php endif; ?>
                            <div class="card h-100 rounded-3" style="background-color: #F2F2F2;">
                                <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                                    <h4 class="mb-4 display-8 lh-1 fw-bold"><?= $rb['titulo']; ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>


<div class="my-5">
    <div class="p-5" style="background-color: #E4E6F2;" class="vh-100 align-items-center">
        <div class="container text-center">
            <h2 class="pb-2 border-bottom">Gestores bibliográficos</h2>

            <div class="row row-cols-1 row-cols-lg-5 align-items-stretch g-2 py-2">
                <?php foreach ($bblio as $index => $rb): ?>

                    <div class="col">
                        <!-- <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-3 shadow-lg" style="background-image: url('<?= base_url('uploads/' . $rb['filename']); ?>');"> -->
                        <?php if (!empty($rb['enlace'])): ?>
                        <a href="<?= $rb['enlace']; ?>" target="_blank" class="text-decoration-none">
                            <?php endif; ?>
                            <div class="card h-100 rounded-3" style="background-color: #04328C;">
                                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                    <h4 class="mb-4 display-8 lh-1 fw-bold"><?= $rb['titulo']; ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div>