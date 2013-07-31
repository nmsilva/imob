<html>
    <head>
        
    </head>
    <body>
        <form action="<?= site_url("android/result") ?>" method="post">
            <input type="hidden" name="tag" value="tipos"/>
            <input type="text" name="id_imovel" value="10"/><br>
            <input type="text" name="preco" value="10000"/><br>
            <input type="text" name="password" value=""/><br>
            <input type="submit" value="enviar"/>
        </form>
    </body>
</html>