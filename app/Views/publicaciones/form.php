<?= $this->extend('layout/main'); ?>


<?= $this->section('content'); ?>

<div class="container mt-5">
        <h1><?= isset($publicacion) ? 'Editar Publicación' : 'Crear Publicación' ?></h1>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <form action="<?= isset($publicacion) ? '/publicaciones/update/' . $publicacion['id'] : '/publicaciones/' ?>" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo"  
 value="<?= old('titulo', $publicacion['titulo'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" id="contenido"  
 name="contenido"><?= old('contenido', $publicacion['contenido'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen_url" class="form-label">Imagen URL (opcional)</label>
                <input type="text" class="form-control" id="imagen_url" name="imagen_url" value="<?= old('imagen_url', $publicacion['imagen_url'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen (opcional)</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <div class="mb-3">
                <label for="fecha_publicacion" class="form-label">Fecha Publicación</label>
                <input type="date" class="form-control" id="fecha_publicacion"  
 name="fecha_publicacion"  
 value="<?= old('fecha_publicacion', $publicacion['fecha_publicacion'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select class="form-select" id="categoria_id" name="categoria_id">  

                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>" <?= isset($publicacion) && $publicacion['categoria_id'] == $categoria['id'] ? 'selected' : '' ?>>
                            <?= $categoria['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug"  
 value="<?= old('slug', $publicacion['slug'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="publicado"  
 <?= isset($publicacion) && $publicacion['estado'] == 'publicado' ? 'selected' : '' ?>>Publicado</option>
                    <option value="borrador" <?= isset($publicacion) && $publicacion['estado'] == 'borrador' ? 'selected' : '' ?>>Borrador</option>
                    <option value="archivado" <?= isset($publicacion) && $publicacion['estado'] == 'archivado' ? 'selected' : '' ?>>Archivado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="enlace" class="form-label">Enlace (opcional)</label>
                <input type="text" class="form-control" id="enlace" name="enlace" value="<?= old('enlace', $publicacion['enlace'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="texto_enlace" class="form-label">Texto Enlace (opcional)</label>
                <input type="text" class="form-control" id="texto_enlace" name="texto_enlace" value="<?= old('texto_enlace', $publicacion['texto_enlace'] ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-primary"><?= isset($publicacion) ? 'Actualizar Publicación' : 'Guardar Publicación' ?></button>
        </form>
    </div>

<?= $this->endSection(); ?>