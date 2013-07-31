<!-- begin sidebar -->
<div class="sidebar">
    <div class="header-sidebar search">
        <h3>PROCURA de Imóveis</h3>
        <span>Insira os dados a baixo...</span>
    </div>
    <div class="content-sidebar">
        <form action="<?= site_url('site/imoveis/search') ?>" method="post">
            <div class="form form-sidebar">
                <div class="input-form">
                    <label>Tipo de Imóvel</label>
                    <select name="tipo_imovel" class="in1">
                        <?php
                                        
                        foreach ($tipos_imoveis as $value) {
                            
                            $select="";
                            if($this->input->post('tipo_imovel')==$value['id_tipo'])
                                $select="SELECTED";
                            
                            echo "<option $select value=".$value['id_tipo'].">".$value['desc_tipo']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-form">
                    <label>Localização(<span>Cidade ou Concelho</span>)</label>
                    <input type="text" class="in1" name="localizacao" value="<?=$this->input->post('localizacao');?>"/>
                </div>
                <div class="input-form in5 left">
                    <label>Preço(<span>de</span>)</label>
                    <input type="text" class="in2 left" name="preco_de" value="<?=$this->input->post('preco_de');?>"/>
                </div>
                <div class="input-form in5 left">
                    <label>Preço(<span>até</span>)</label>
                    <input type="text" class="in2 left" name="preco_ate" value="<?=$this->input->post('preco_ate');?>"/>
                </div>
                <div class="input-form">
                    <input type="submit" class="btn in1" value="Procurar"/>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end sidebar -->
