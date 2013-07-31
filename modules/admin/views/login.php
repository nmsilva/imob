
<div id="left"></div>
<div id="right"></div>
<div id="top"></div>
<div id="bottom"></div>

<div id="login-box">
        <header id="main">
                <div id="login-logo"></div>
        </header>
    <form action="<?= site_url('admin/home/login') ?>" method="post" accept-charset="utf-8">
                
        <div class="error">
            <?= validation_errors(); ?>
        </div>
        
                <ul>
                        <li>
                                <input type="text" value="<?=set_value('email');?>" name="email" placeholder="E-mail">
                                <img class="input-email" alt="E-mail" src="<?= img_path('email-icon.png','admin') ?>">
                        </li>
                        <li>
                                <input type="password" name="password" placeholder="Senha">
                                <img class="input-password" alt="Senha" src="<?= img_path('lock-icon.png','admin') ?>">
                        </li>
                        <li><center><input class="button" type="submit" name="submit" value="Entrar"></center></li>
                </ul>
        </form>	
</div>

