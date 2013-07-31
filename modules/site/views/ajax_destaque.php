<?php //sleep(2); ?>

<!-- begin dados-imoveis-->
<div class="dados-imovel">
    <h3><?= $imoveis[0]['titulo']?></h3>
    <table>
        <tr>
            <td>Tipo de Imóvel</td>
            <td class="right"><?= $imoveis[0]['desc_tipo']?></td>
        </tr>
        <tr>
            <td>Localização</td>
            <td class="right"><?= $imoveis[0]['localidade']?></td>
        </tr>
        <tr>
            <td>Ano de Construção</td>
            <td class="right"><?= $imoveis[0]['ano']?></td>
        </tr>
        <tr>
            <td>Área do Terreno</td>
            <td class="right"><?= $imoveis[0]['area_terreno']?> m2</td>
        </tr>
    </table>
    <div class="preco-imovel">
        <span><?= $imoveis[0]['preco']?>€</span>
        <a href="<?= site_url('site/imovel/view/'.$imoveis[0]['nimovel']); ?>" class="btn">Detalhes</a>
    </div>
    <!-- end dados-imoveis-->
</div>
<!-- imagem destaque-->
<div class="imagem-imovel">
    <?php $imagem=$this->imovel_model->get_img_destaque($imoveis[0]['nimovel']); ?>
    <img src="<?= img_path()."imoveis/destaques/".$imagem[0]['path'];?>" alt="casa"/>
</div>