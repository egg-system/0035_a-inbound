<div class="content-none">
  <!-- ここに冒頭文を書く -->
  <?php if( is_404() ){
    // 404ページの場合
    echo '<p>あなたがアクセスしようとしたページは削除されたかURLが変更されています。お手数をおかけしますが、以下の方法からもう一度目的のページをお探し下さい。</p>';
  }elseif( is_search() ){
    // 検索結果ページの場合
    $r = get_search_query();
    echo '<p>「'.$r.'」で検索しましたがページが見つかりませんでした。お手数をおかけしますが、以下の方法からもう一度目的のページをお探し下さい。</p>';
  }else{
    // その他カテゴリーなどの一覧ページ
    echo '<p>いつも当サイトをご覧頂きありがとうございます。投稿が見つかりませんでした。投稿が全て削除されたか、まだ投稿されておりません。お手数をおかけしますが、以下の方法からもう一度目的のページをお探し下さい。</p>';
  } ?>
  <h2>１．人気の記事から見つける</h2>
    <?php

    // クエリ
    $args = array(
      'showposts' => 20,
      'meta_key'  => 'views',
      'orderby'   => 'meta_value_num',
      'order'     => 'DESC'
    );
    $the_query = new WP_Query( $args );
    
    // ループ
    echo '<ol>';
    
    $i = 1;
    while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>
      <li class="content-none-views content-none-views-<?php echo $i; ?>">
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
      </li>
    <?php
    $i++;
    endwhile;
    // 投稿データをリセット
    wp_reset_postdata();
    echo '</ol>';
    
    ?>
  <h2>２．カテゴリーから見つける</h2>
  <!-- カテゴリー一覧を表示 -->
  <p>それぞれのカテゴリーのトップページからもう一度目的のページをお探しになってみて下さい。</p>
  <ul>
  <?php
    wp_list_categories(
      array(
        'title_li'  => '',
        'depth'     => 1
      )
    );
  ?>
  </ul>
</div>
