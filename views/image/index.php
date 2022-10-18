<?php
$Image = new Classe\Image();
if (!empty($_FILES['image'])) {
    $Image->save($_FILES['image'], 'image/image', '300');
    echo '<script language= "JavaScript">location.href="' . URL_ATUAL . '"</script>';
}
if (!empty($_POST['location'])) {
    $Image->trash($_POST['location']);
    echo '<script language= "JavaScript">location.href="' . URL_ATUAL . '"</script>';
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 pt-3">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Inserir Imagens</h4>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image[]" multiple>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button name="insertImg" type="submit" class="btn btn-sm btn-secondary btn-block">Salvar</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="row">
                <?php foreach ($Image->listImgDirectory('image/image/') as $valueImgDirectory) { ?>
                    <div class="col-lg-2 mb-3">
                        <div class="card">
                            <div class="card-body p-3">
                                <table align="center">
                                    <tr>
                                        <td height='220px'><img style="max-width: 120px;" src="<?php echo $valueImgDirectory; ?>"></td>
                                    </tr>
                                    <tr>
                                        <form method="POST">
                                            <td class="pt-1">
                                                <input type="hidden" name="location" value="<?php echo $valueImgDirectory; ?>">
                                                <button class="btn btn-outline-secondary btn-sm btn-block" type="submit">Excluir</button>
                                            </td>
                                        </form>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>