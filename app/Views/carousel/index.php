<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

    <h1>Publicación</h1>

    <a href="/carousel/create">Nueva publicación</a>

    <table id="example" class="display table-hover table-responsive mt-3">
    <thead>
            <tr>
                <th>ID</th>
                <th>Filename</th>
                <th>Titulo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carouselItems as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td>
                        <a href="<?= base_url('writable/uploads/' . $item['filename']); ?>" target="_blank">
                            <img src="<?= base_url('uploads/' . $item['filename']); ?>" alt="<?= $item['filename']; ?>" style="width: 100px;">
                        </a>
                    </td>
                    <td><?= $item['titulo'] ?></td>
                    <td><?= $item['estado'] ?></td>
                    <td>
                        <a href="/carousel/edit/<?= $item['id'] ?>">Edit</a>
                        <a href="/carousel/delete/<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<?= $this->endSection(); ?>