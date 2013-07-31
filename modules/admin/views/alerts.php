
<?php if($this->session->flashdata('sucess')){?>
<div class="alert success"><a href="#" class="close">x</a>
	<?=$this->session->flashdata('sucess')?>
</div>
<?php }elseif($this->session->flashdata('error')){?>
<div class="alert error"><a href="#" class="close">x</a>
	<?=$this->session->flashdata('error')?>
</div>
<?php }elseif($this->session->flashdata('warning')){?>
<div class="alert warning"><a href="#" class="close">x</a>
	<?=$this->session->flashdata('warning')?>
</div>
<?php }?>