<?php get_header(); ?>


<div id="content">

<div class="wrap">

  

  <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
    
    <div class="main-inner">
    
    <?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
    ?>
        
    <?php 
    global $post;
    $cf = get_post_meta($post->ID);
    $facebook_page_url = '';
    $facebook_page_url = get_option('facebook_page_url');
    $post_cat = '';
    ?>
    <article id="post-<?php the_id(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

      <header class="sp_only post-header">
        <div class="cat-name">
          <span>
            <?php
              $category = get_the_category(); 
              echo $category[0]->cat_name;
            ?>
          </span>
        </div>
        <?php if (canRead($post->ID)) { ?>
            <h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
        <?php } else { ?>
            <h1 class="post-title" itemprop="headline">会員限定の商品です</h1>
        <?php } ?>
        <?php if (canRead($post->ID)) { ?>
            <?php if (isset($cf["rating"][0])) { ?>
              <?php echo getRatingStar($cf["rating"][0]); ?>
            <?php } ?>
            <?php if (isset($cf["jancode"][0])) { ?>
              <br>JANコード:<?php echo $cf["jancode"][0]; ?>
            <?php } ?>
        <?php } ?>
      </header>

      <?php if (canRead($post->ID)) { ?>
          <?php if( get_the_post_thumbnail() ) : ?>
          <div class="post-thumbnail">
            <?php the_post_thumbnail(array(1200, 630, true)); ?>
          </div>
          <?php endif; ?>
      <?php } ?>

      <header class="pc_only post-header">
        <div class="cat-name">
          <span>
            <?php
              $category = get_the_category(); 
              echo $category[0]->cat_name;
            ?>
          </span>
        </div>
        <?php if (canRead($post->ID)) { ?>
            <h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
        <?php } else { ?>
            <h1 class="post-title" itemprop="headline">会員限定の商品です</h1>
        <?php } ?>
        <?php if (canRead($post->ID)) { ?>
            <?php if (isset($cf["rating"][0])) { ?>
              <?php echo getRatingStar($cf["rating"][0]); ?>
            <?php } ?>
            <?php if (isset($cf["jancode"][0])) { ?>
              <br>JANコード:<?php echo $cf["jancode"][0]; ?>
            <?php } ?>
        <?php } ?>
      </header>

      <section class="post-content" itemprop="text">
        <?php the_content(); ?>
      </section>

      <footer class="post-footer">
      
        
        <ul class="post-footer-list">
          <li class="cat"><i class="fa fa-folder"></i> <?php the_category(', ');?></li>
          <?php 
          $posttags = get_the_tags();
          if($posttags){ ?>
          <li class="tag"><i class="fa fa-tag"></i> <?php the_tags('');?></li>
          <?php } ?>
        </ul>
      </footer>

      <?php echo bzb_get_cta($post->ID); ?>
      
    <?php if( is_active_sidebar('under_post_area') ){ ?>
    <div class="post-share">
      <?php dynamic_sidebar('under_post_area');?>
    </div>
    <?php } ?>
      
    </article>
      
        <?php

				endwhile;

			else :
		?>
    
    <p>投稿が見つかりません。</p>
				
    <?php
			endif;
		?>


    </div><!-- /main-inner -->
  </div><!-- /main -->
  
<?php get_sidebar(); ?>

</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>


