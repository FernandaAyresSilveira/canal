<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Devas Conectadas - Descomplicando a tecnologia</title>
  <?php echo link_tag('./assets/css/style.css?v=2'); ?>
  <link rel="icon" type="image/x-icon" href="<?php echo base_url('./assets/img/favicon.ico');?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>
<body>
  <header id="header-mobile">
    <div id="nav-icon2">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    <a href="<?php echo site_url(); ?>">
        <img id="logo" src="<?php echo base_url('./assets/img/logo.png');?>">
    </a>


  </header>
  <div id="menu-mobile">
      <div class="quick_access col-3 col-md-3 col-sm-4 col-xsm-12">

      <div class="search">
          <form action="<?php echo base_url('posts/list'); ?>" method="get"  >
            <input type="text" name="q" placeholder="Pesquisar..." <?php if ($this->input->get('q')) { echo "value='".$this->input->get('q')."'"; } ?>>
            <button type="button">
              <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"/></svg>
            </button>
          </form>
        </div>
        <div class="categories">
            <?php foreach ($this->dados_globais['categorias'] as $cat){?> 
              <a href="<?php echo site_url('posts/categories/'.$cat->id.'/'.$cat->amigavel); ?>"><?php echo $cat->nome; ?></a>
            <?php } ?>
        </div>
        <div class="tags">
           <?php foreach ($this->dados_globais['tags_posts'] as $tag){?> 
              <a href="<?php echo site_url('posts/tags/'.$tag->tag_id.'/'.$tag->nome); ?>"><?php echo $tag->tag_nome; ?></a>
            <?php } ?>
        </div>
      </div>
    </div>
    <header id="header-desktop">
    	<div id="banner">
    		<img src="<?php echo base_url('./assets/img/header2.jpg');?>">
    	</div>
    	<a href="<?php echo site_url(); ?>">
    		<img id="logo" src="<?php echo base_url('./assets/img/logo.png');?>">
    	</a>
        
    </header>
    <div id="content">