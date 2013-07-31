
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
    })
</script>

<div id="content-body">
    <section class="title">
        <h4>Adicionar Novo Imóvel</h4>
    </section>
    <section class="item">
        
        <?= form_open('admin/imoveis/save',array('enctype'=>'multipart/form-data'));?>
        
            <div class="error">
                <?= validation_errors(); ?>
            </div>
        
            <div id="tabs-imovel" class="tabs">
                <ul>
                        <li><a href="#geral">Geral</a></li>
                        <li><a href="#imagens">Imagens</a></li>
                </ul>
                <div id="geral">
                    <div class="form_inputs">
                        <ul>
                            <li class="even">
                                <label>Título<span>*</span></label>
                                <div class="input"><input type="text" name="titulo" value="<?=set_value('titulo');?>" style="width: 95% !important;"></div>
                            </li>
                            <li class="even">
                                <label>Tipo de Imóvel<span>*</span></label>
                                <div class="input">
                                    <select name="tipo">
                                        
                                        <?php
                                        
                                        foreach ($tipos_imoveis as $value) {
                                            echo "<option value=".$value['id_tipo'].">".$value['desc_tipo']."</option>";
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                            </li>
                            <li class="even">
                                <label>Preço<span>*</span></label>
                                <div class="input"><input type="text" name="preco" value="<?=set_value('preco');?>"></div>
                            </li>
                            <li class="even">
                                <label>Área do Terreno<span>*</span></label>
                                <div class="input"><input type="text" name="area" value="<?=set_value('area');?>"></div>
                            </li>
                            <li class="even">
                                <label>Ano de Construção<span>*</span></label>
                                <div class="input"><input type="text" name="ano" value="<?=set_value('ano');?>"></div>
                            </li>
                            <li class="even">
                                <label>Descrição<span>*</span></label>
                                <div class="input"><textarea name="descricao" style="width: 95% !important; height: 120px;"><?=set_value('descricao');?></textarea></div>
                            </li>
                            <li class="even">
                                <label>Localidade(Distrito/Concelho)<span>*</span></label>
                                <div class="input"><input type="text" name="localidade" value="<?=set_value('localidade');?>" style="width: 95% !important;"></div>
                            </li>
                            <li class="even">
                                <label>Morada(Cod-Postal, Morada)<span>*</span></label>
                                <div class="input">
                                    <input type="text" name="morada" value="<?=set_value('morada');?>" style="width: 85% !important;">
                                    <a href="" id="view_map" class="btn orange">Ver Mapa</a>
                                </div>
                            </li>
                            <li class="even">
                                <label>Mapa</label>
                                <div class="input" id="mapa">
                                    <div id="map"></div>
                                    <input type="hidden" name="long" value="<?=set_value('long');?>"/>
                                    <input type="hidden" name="lat" value="<?=set_value('lat');?>"/>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div id="imagens">
                    <div class="form_inputs">
                        <ul>
                            <li class="even">
                                <label>Imagem de Destaque</label>
                                <div class="input">
                                    <input type="file" name="imagem" size="20" />
                                </div>
                            </li>
                            <li class="even">
                                <label>Imagens</label>
                                <div class="input">
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
                        </ul>
                    </div>
                </div>
            </div>
        
            <div>
                <button type="submit" name="btnAction" value="save" class="btn blue">
                    <span>Gravar</span>
                </button>
                <button type="submit" name="btnAction" value="save" class="btn blue">
                    <span>Gravar e Sair</span>
                </button>
                <?=anchor('admin/imoveis', 'Cancelar', 'class="btn gray cancel"');?>
            </div>
        <?= form_close(); ?>
    </section>
</div>