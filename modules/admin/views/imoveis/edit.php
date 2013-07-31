<?= css('jquery.ui/jquery.ui.all.css') ?>
<?= js(array('jquery.ui/jquery.ui.core','jquery.ui/jquery.ui.widget','jquery.ui/jquery.ui.tabs')); ?>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAwCyAriWh2LFvzH21u0FTBdWMAHzkG9Wc&sensor=true"
    type="text/javascript"></script>
    
<script type="text/javascript">
    
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-26906762-1']);
    _gaq.push(['_trackPageview']);

    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    
    $(function() {
            $( "#tabs-imovel" ).tabs();
    });

    $(document).ready(function(){ 
        
        $("#view_map").click(function(){
            
            
            $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?= site_url('admin/imoveis/map') ?>",
                    data: "morada="+ $('input[name=morada]').val(),
                    success: function (result)
                    {
                            $('input[name=long]').val(result.lon);
                            $('input[name=lat]').val(result.lat);
                            
                            
                            getmapa(result.lat,result.lon);
            
                    }
            });
            
            return false;
        });
        
        getmapa(<?= $imovel[0]['lati'] ?>,<?= $imovel[0]['longi'] ?>);
        
    })
    
    function getmapa(lat,lon){
    
        if (GBrowserIsCompatible()) {

            var map = new GMap2($("#map").get(0));

            var zoom =12;
            var point;

            map.addControl(new GMapTypeControl());
            map.addControl(new GLargeMapControl());
            map.setCenter(new GLatLng(lat, lon), zoom);

            var marker = new GMarker(new GLatLng(lat,lon));
            GEvent.addListener(marker, "click", function() {

                marker.openInfoWindowHtml("");

            });
            map.addOverlay(marker);
            map.setCenter(point, zoom);
        }
    }
</script>
<div id="content-body">
    <section class="title">
        <h4>Adicionar Novo Imóvel</h4>
    </section>
    <section class="item">
        
            <div id="tabs-imovel" class="tabs">
                <ul>
                        <li><a href="#geral">Geral</a></li>
                        <li><a href="#imagens">Imagens</a></li>
                </ul>
                <div id="geral">
                    <?= form_open('admin/imoveis/save',array('enctype'=>'multipart/form-data'));?>
                        <div class="error">
                            <?= validation_errors(); ?>
                        </div>
                    
                        <div class="form_inputs">
                        
                            <input type="hidden" name="id" value="<?=$imovel[0]['nimovel']?>"/>
                        

                            <ul>
                                <li class="even">
                                    <label>Título<span>*</span></label>
                                    <div class="input"><input type="text" name="titulo" value="<?=set_value('titulo', $imovel[0]['titulo']);?>" style="width: 95% !important;"></div>
                                </li>
                                <li class="even">
                                    <label>Tipo de Imóvel<span>*</span></label>
                                    <div class="input">
                                        <select name="tipo">

                                            <?php

                                            foreach ($tipos_imoveis as $value) {
                                                $select="";
                                                if($imovel[0]['id_tipo']==$value['id_tipo'])
                                                    $select="SELECTED";

                                                echo "<option $select value=".$value['id_tipo'].">".$value['desc_tipo']."</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </li>
                                <li class="even">
                                    <label>Preço<span>*</span></label>
                                    <div class="input"><input type="text" name="preco" value="<?=set_value('preco',$imovel[0]['preco']);?>"></div>
                                </li>
                                <li class="even">
                                    <label>Área do Terreno<span>*</span></label>
                                    <div class="input"><input type="text" name="area" value="<?=set_value('area',$imovel[0]['area_terreno']);?>"></div>
                                </li>
                                <li class="even">
                                    <label>Ano de Construção<span>*</span></label>
                                    <div class="input"><input type="text" name="ano" value="<?=set_value('ano',$imovel[0]['ano']);?>"></div>
                                </li>
                                <li class="even">
                                    <label>Descrição<span>*</span></label>
                                    <div class="input"><textarea name="descricao" style="width: 95% !important; height: 120px;"><?=set_value('descricao',$imovel[0]['descricao']);?></textarea></div>
                                </li>
                                <li class="even">
                                    <label>Localidade(Distrito/Concelho)<span>*</span></label>
                                    <div class="input"><input type="text" name="localidade" value="<?=set_value('localidade',$imovel[0]['localidade']);?>" style="width: 95% !important;"></div>
                                </li>
                                <li class="even">
                                    <label>Morada(Cod-Postal, Morada)<span>*</span></label>
                                    <div class="input">
                                        <input type="text" name="morada" value="<?=set_value('morada',$imovel[0]['morada']);?>" style="width: 85% !important;">
                                        <a href="" id="view_map" class="btn orange">Ver Mapa</a>
                                    </div>
                                </li>
                                <li class="even">
                                    <label>Mapa</label>
                                    <div class="input" id="mapa">
                                        <div id="map"></div>
                                        <input type="hidden" name="long" value="<?=set_value('long',$imovel[0]['longi']);?>"/>
                                        <input type="hidden" name="lat" value="<?=set_value('lat',$imovel[0]['lati']);?>"/>
                                    </div>
                                </li>
                                <li>
                                    <label></label>
                                    <div class="input" id="mapa">
                                        <div>
                                            <button type="submit" name="save" value="save" class="btn blue">
                                                <span>Gravar</span>
                                            </button>
                                            <button type="submit" name="exit" value="save" class="btn blue">
                                                <span>Gravar e Sair</span>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        
                        </div>
                    <?= form_close(); ?>
                </div>
                <div id="imagens">
                    <?= form_open('admin/imoveis/upload_imagens/'.$imovel[0]['nimovel'],array('enctype'=>'multipart/form-data'));?>
                        <div class="form_inputs">
                        

                            <ul>                            
                                <li class="even">
                                    <label>Imagem de Destaque</label>
                                    <div class="input">
                                        <?php if($imagem_destaque[0]['path']){?>
                                            <img src="<?= img_path()."imoveis/destaques/".$imagem_destaque[0]['path'];?>" alt="" />
                                            <br><a href="<?= site_url('admin/imoveis/delimage/'.$imagem_destaque[0]['id_imagem'].'/'.$imovel[0]['nimovel']); ?>" class="btn red">Apagar Imagem</a>
                                        <?php }else{?>
                                            <input type="file" name="imagem" size="20" />
                                        <?php }?>

                                    </div>
                                </li>
                                <li class="even">
                                    <label>Imagens</label>
                                    <div class="input">
                                        <ul>
                                        <?php foreach ($imagens as $value) {?>
                                            <li>
                                                <img src="<?= img_path()."imoveis/thumbs/".$value['path'];?>" alt="" />
                                                <a href="<?= site_url('admin/imoveis/delimage/'.$value['id_imagem'].'/'.$imovel[0]['nimovel']); ?>" class="btn red">Apagar Imagem</a>
                                            </li>
                                        <?php }?>
                                        </ul>

                                        <br>
                                        <input type="file" name="imagem1" size="20" />
                                        <input type="file" name="imagem2" size="20" />
                                        <input type="file" name="imagem3" size="20" />
                                        <input type="file" name="imagem4" size="20" />
                                        <input type="file" name="imagem5" size="20" />
                                        <input type="file" name="imagem6" size="20" />
                                        <input type="file" name="imagem7" size="20" />
                                        <input type="file" name="imagem8" size="20" />
                                        <input type="file" name="imagem9" size="20" />
                                        <input type="file" name="imagem10" size="20" />
                                    </div>
                                </li>
                                <li>                                
                                    <button type="submit" name="btnAction" value="save" class="btn orange">
                                        <span>Carregar Imagens</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        
            <div>
                <?=anchor('admin/imoveis', 'Cancelar', 'class="btn gray cancel"');?>
            </div>
        
    </section>
</div>
