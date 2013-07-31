 <div class="content text">
    <h1>Lista de Imoveis para Venda</h1>

    <!-- begin lista de imoveis -->
    <div class="lista-imoveis">
        
        <?php foreach ($imoveis as $value) {
            
            $imagem=$this->imovel_model->get_img_destaque($value['nimovel']);
            ?>
        
            <!-- begin imovel -->
            <div class="imovel-lista">
                <img src="<?= img_path()."imoveis/thumbs/".$imagem[0]['path'];?>" alt=""/>
                <div class="detalhes">
                    <h3><?= $value['titulo'] ?></h3>
                    <p><?= $value['morada'] ?></p>
                    <span class="preco"><?= $value['preco'] ?>€</span>

                </div>
                <div class="link">
                    <a href="<?= site_url("site/imovel/view/".$value['nimovel']); ?>" class="btn">Detalhes</a>
                </div>
            </div>
            <!-- end imovel -->
            
        <?php } ?>
        
    </div>
    <!-- end lista de imoveis -->

    <!-- begin pagination -->
    <div class="pagination">
<!--        <span>Pagina <b><?=$this->pagination->cur_page+1; ?></b> de <b><?=$this->pagination->num_links; ?></b></span>-->
        
        <?=$this->pagination->create_links(); ?>
<!--        <ul>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href="">5</a></li>
        </ul>-->
    </div>
    <!-- end pagination -->

</div>
