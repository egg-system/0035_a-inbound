<?php get_header(); ?>

<div id="content">

<div class="wrap">

  <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
    <div class="main-inner">

    <div id="t_sort">
      <div class="box1">
      <h1 class="post-title" ><?php bzb_title(); ?>
      <?php 
          // 総件数を表示
          echo "　(" . $wp_query->found_posts . "件)"; 
      ?>
      </h1>
      </div>

      <div class="box2">
並び替え：
         <?php $selected = getSearchParam(); ?>
         <select onChange="location.href=value;">
           <option value="./">指定なし</option>
           <option value="./?orderby=title&order=asc" <?php echo isset($selected['title']) ? $selected['title'] : ''; ?>>商品名順</option>
           <option value="./?orderby=date&order=desc" <?php echo isset($selected['date']) ? $selected['date'] : ''; ?>>新着順</option>
           <option value="./?orderby=meta_value_num&meta_key=views&order=desc" <?php echo isset($selected['views']) ? $selected['views'] : ''; ?>>閲覧数順</option>
           <option value="./?orderby=meta_value_num&meta_key=rating&order=desc" <?php echo isset($selected['rating']) ? $selected['rating'] : ''; ?>>ランク順</option>
         </select>
      </div>
    </div>

    <div class="post-loop-wrap">

    <?php if( is_category() ) { ?>
        <?php /*bzb_category_description();*/ ?>
    <?php } ?>

    <?php

			if ( have_posts() ) :

				while ( have_posts() ) : the_post();

        $cf = get_post_meta($post->ID); ?>
    <article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

      <header class="post-header">
        <div class="cat-name">
          <span>
            <?php
              $category = get_the_category();
              echo $category[0]->cat_name;
            ?>
          </span>
        </div>
        <?php if (canRead($post->ID)) { ?>
            <h2 class="post-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php } else { ?>
            <h2 class="post-title" itemprop="headline"><a href="<?php the_permalink(); ?>">会員限定の商品です。</a></h2>
        <?php } ?>
      </header>

      <div class="post-meta-area">
        <ul class="post-meta list-inline">
          <li class="date" itemprop="datePublished" datetime="<?php the_time('c');?>"><i class="fa fa-clock-o"></i> <?php the_time('Y.m.d');?></li>
        </ul>
        <?php if (canRead($post->ID)) { ?>
            <ul class="post-meta-comment">
              <?php if (isset($cf["rating"][0])) { ?>
                <li class="author" style="border: none;">
                <?php echo getRatingStar($cf["rating"][0]); ?>
                </li>
              <?php } ?>
              <?php $posttags = get_the_tags();
              if ($posttags){ ?>
              <li class="tag"><i class="fa fa-tag"></i> <?php the_tags('');?></li>
              <?php } ?>
            </ul>
        <?php } ?>
      </div>

      <?php if (canRead($post->ID)) { ?>
          <?php if( get_the_post_thumbnail() ) { ?>
          <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_post_thumbnail('big_thumbnail'); ?></a>
          </div>
          <?php } ?>
      <?php } ?>

      <?php if (canRead($post->ID)) { ?>
      <section class="post-content" itemprop="text">
        <?php the_excerpt(); ?>
      </section>
      <?php } ?>

    </article>

    <?php

				endwhile;

			else :
		?>

    <article id="post-404"class="cotent-none post" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
      <section class="post-content" itemprop="text">
        <?php echo get_template_part('content', 'none'); ?>
      </section>
    </article>
    <?php
			endif;
		?>

<?php if (function_exists("pagination")) {
    pagination($wp_query->max_num_pages);
} ?>

    </div><!-- /post-loop-wrap -->



    </div><!-- /main-inner -->
  </div><!-- /main -->

<?php get_sidebar(); ?>

</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>


