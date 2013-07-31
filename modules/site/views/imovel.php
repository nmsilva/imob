<div class="content text">
    <h1><?= $imovel[0]['titulo']?></h1>

    <div class="imovel">
        <div class="imagem-imovel">
            <img src="<?= img_path()."imoveis/destaques/".$imagem_destaque[0]['path'];?>" alt="" />
        </div>
        <div class="info-imovel">
            <div class="dados-imovel">
                <p><b>Tipo de Imóvel: </b> <?= $imovel[0]['desc_tipo']?></p>
                <p><b>Localização: </b> <?= $imovel[0]['localidade'].", ".$imovel[0]['morada'] ?></p>
                <p><b>Área do Terreno: </b> <?= $imovel[0]['area_terreno']?>m2</p>
                <p><b>Ano de Construção: </b> <?= $imovel[0]['ano']?></p>
                <p><b>Preço: </b> <?= $imovel[0]['preco']?>€</p>
            </div>
            <div class="descricao-imovel">
                <h3>Descrição</h3>
                <p><?= $imovel[0]['descricao']?></p>
            </div>
        </div>
        <div class="fotos-imovel">
            <h3>Fotos</h3>
            <ul>
                <?php foreach ($imagens as $value) {?>
                    <li>
                        <a href="<?= img_path()."imoveis/".$value['path'];?>" rel="photo_gallery">
                            <span class="pover">&nbsp;</span>
                            <img src="<?= img_path()."imoveis/thumbs/".$value['path'];?>" alt="" />
                        </a>
                    </li>
                <?php }?>
                                            
            </ul>
        </div>
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

            $(document).ready(function(){

                if (GBrowserIsCompatible()) {

                        var map = new GMap2(document.getElementById("map"));

                        var lat=<?= $imovel[0]['lati']?>;
                        var lon=<?= $imovel[0]['longi']?>;
                        var zoom =12;
                        var point;

                        map.addControl(new GMapTypeControl());
                        map.addControl(new GLargeMapControl());
                        map.setCenter(new GLatLng(lat, lon), zoom);

                        var marker = new GMarker(new GLatLng(lat,lon));
                        GEvent.addListener(marker, "click", function() {

                        marker.openInfoWindowHtml("<p>Casa</p>");

                        });
                        map.addOverlay(marker);
                        map.setCenter(point, zoom);
                }

            });

        </script>

        <div class="localizacao-imovel">
            <h3>Localização</h3>
            <div id="map">

            </div>
        </div>
    </div>
</div>

        
