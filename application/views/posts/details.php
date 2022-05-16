<div class="recentes_posts col-9 col-md-9 col-sm-8 col-xsm-12">
      <div class="each">
        <div class="header">
          <div class="calendar">
            <b><?php echo dia($post->data);?></b>
            <span><?php echo mes($post->data);?></span>
          </div>
          <img src="<?php echo base_url('./admin/assets/upload/posts/'.$post->imagem);?>">
        </div>
        <div class="text">
          <h2><?php echo $post->titulo; ?></h2>
          <span>
            <?php echo  $post->texto; ?>
          </span>
        </div>
      </div>
    
</div>