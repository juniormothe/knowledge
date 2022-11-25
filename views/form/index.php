<div class="container">
    <div class="row">

        <div class="col-lg-12">
            <?php
            $Form = new Classe\Form('teste', ['method' => 'GET']);
            $Form->addInput('Nome', 'text', 'name', ['class' => 'form-control', 'size' => 6, 'required' => 1]);
            $Form->addInput('Data nascimento', 'date', 'birthday', ['class' => 'form-control', 'size' => 6, 'required' => 1]);
            $Form->renderForm();
            ?>
        </div>


        <br><br>
    </div>
</div>