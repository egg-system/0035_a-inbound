<?php get_header(); ?>

<div id="main_visual">
  <div class="wrap">
    <h2><?php echo nl2br(get_option('top_catchcopy'));?></h2>
    <p><?php echo nl2br(get_option('top_description'));?></p>
  </div><!-- .wrap -->
</div>

<div id="content">

<div id="main">
  <div class="main-inner">

<!-- サービス紹介 -->
<?php
  $icon = 'none';
  $title = '';
  $bzb_ruby = '';
  $bzb_catch = '';
  $bzb_service_header_array = get_option('bzb_service_header');
  if(is_array($bzb_service_header_array)){
    extract($bzb_service_header_array) ;
  }

?>
<div id="front-service" class="front-main-cont">

  <header class="category_title main_title front-cont-header">
    <div class="cont-icon"><i class="<?php echo $icon;?>"></i></div>
    <h2 class="cont-title"><?php echo $title;?></h2>
    <p class="cont-ruby"><?php echo $ruby;?></p>
    <div class="tri-border"><span></span></div>
  </header>


  <div class="wrap">
    <div class="front-service-inner">

<?php
  $i = 1;
  $bzb_service = get_option('bzb_service');
  if(isset($bzb_service)){
  foreach((array)$bzb_service as $key => $value){
    extract(make_info_4top($value));
?>
      <section id="front-service-1" class="c_box">
        <div class="c_title">
          <h3><?php echo $title;?></h3>
          <!-- <p class="c_english"><?php //echo $bzb_ruby;?></p> -->
        </div>
        <div class="c_text">
          <!-- <h4><?php //echo nl2br($bzb_catch);?></h4> -->
          <p><?php echo $service;?></p>
        </div>
      </section>
  <?php
    }
  }
  ?>    
    </div>
  </div>
</div><!-- /front-contents -->

<div id="popular_post_content" class="front-loop">
<a href="https://a-inbound.com/tag/%E7%84%A1%E6%96%99/"><h2>無料のおすすめ商品</h2></a>
<div class="wrap">
  <div class="front-loop-cont">
<?php
      $i = 1;
      if ( have_posts() ) :
        wp_reset_query();

      /*
        $args=array(
            'meta_query'=>
            array(
              array('terms'=>array(6),
                    'operator'=>'NOT IN'
              ),
             'relation'=>'AND'
          ),
            'showposts'=>5,
            'order'=>'DESC'
          );
        query_posts($args);
       */
        // tag_id=6が無料
        query_posts('showposts=10&meta_key=views&orderby=meta_value_num&order=DESC&tag_id=6');
        while ( have_posts() ) : the_post();

        $cf = get_post_meta($post->ID);
        $rank_class = 'popular_post_box rank-'.$i;
        // print_r($cf);
        //error_log(print_r($cf,true)."\n", 3, "/tmp/error.log");
?>

  <article id="post-<?php echo the_ID(); ?>" <?php post_class($rank_class); ?>>
    <a href="<?php the_permalink(); ?>" class="wrap-a">

      <?php if( get_the_post_thumbnail() ) { ?>
      <div class="post-thumbnail">
        <?php the_post_thumbnail('loop_thumbnail'); ?>
      </div>
      <?php } else{ ?>
        <img src="<?php echo get_template_directory_uri(); ?>/lib/images/noimage.jpg" alt="noimage" width="800" height="533" />
      <?php } // get_the_post_thumbnail ?>
    <p class="p_category"><?php $cat = get_the_category(); $cat = $cat[0]; {
        echo $cat->cat_name;
      } ?></p>
    <h3><?php the_title(); ?>
    <?php if (isset($cf["rating"][0])) { ?>
      <br><?php echo getRatingStar($cf["rating"][0]); ?>
    <?php } ?>
   </h3>
    
    </a>
  </article>

<?php
        $i++;
        endwhile;
      endif;
?>
</div><!-- /front-loop-cont -->
</div><!-- /wrap -->
</div><!-- popular_post_content -->

<div id="membrBtn">
<h2><a href="https://a-inbound.com/membership-registration/">新規会員登録へ</a></h2>
</div>

  </div><!-- /main-inner -->
</div><!-- /main -->
  
</div><!-- /content -->
<?php get_footer(); ?>

<script>
// トップのメイン画像を横幅に合わせる
jQuery(document).ready(function () {
  width = jQuery(window).width();
  jQuery("#main_visual").css("height", width/2.3 + "px");
});
jQuery(window).resize(function () {
  width = jQuery(window).width();
  jQuery("#main_visual").css("height", width/2.3 + "px");
});
</script>
