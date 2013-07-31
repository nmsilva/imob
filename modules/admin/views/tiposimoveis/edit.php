<div id="content-body">
    <section class="title">
        <h4>Editar Tipo de Imóvel</h4>
    </section>
    <section class="item">
        <?= form_open('admin/tiposimoveis/save');?>
        
            <input type="hidden" name="id" value="<?=$tipo[0]['id_tipo']?>"/>
            
            <div class="error">
                <?= validation_errors(); ?>
            </div>
        
            <div class="form_inputs">
                <ul>
                    <li class="even">
                        <label>Título <span>*</span></label>
                        <div class="input"><input type="text" name="titulo" value="<?=set_value('titulo',$tipo[0]['desc_tipo']);?>"></div>
                    </li>
                </ul>
            </div>
            <div>
                <button type="submit" name="btnAction" value="save" class="btn blue">
                    <span>Gravar</span>
                </button>
                <?=anchor('admin/tiposimoveis', 'Cancelar', 'class="btn gray cancel"');?>
            </div>
        
        <?= form_close(); ?>
    </section>
</div>