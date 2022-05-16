<div class="recentes_posts col-9 col-md-9 col-sm-8 col-xsm-12">
    <?php foreach ($posts as $p){?> 
      <div class="each">
        <div class="header">
          <div class="calendar">
            <b><?php echo dia($p->data);?></b>
            <span><?php echo mes($p->data);?></span>
          </div>
          <img src="<?php echo base_url('./admin/assets/upload/posts/'.$p->imagem);?>">
        </div>
        <div class="text">
          <h2><?php echo $p->titulo; ?></h2>
          <span>
            <?php echo  mb_strimwidth($p->texto,0, 400,'...'); ?>
          </span>
        </div>
        <a href="<?php echo site_url('posts/details/'.$p->id.'/'.$p->amigavel); ?>">Leia Mais</a>
      </div>
    <?php }?>
    <br class="clear" />

      <div id="pagination">
        <?php
          echo $this->pagination->create_links();
        ?>
      </div>
      <br class="clear">    
</div>