<footer id="footer">
  <div class="footer-01">
    <div class="wrap">

      <div id="footer-content-area" class="row">
        <div id="footer-list-area" class="gr6">
          <div class="row">

      <?php if( has_nav_menu( 'footer_nav' ) ){
      //bzb_get_nav_menu_name();
        echo '<div id="footer-cont-about" class="gr4">';
        echo "<h4>" . get_option('footer_menu_title') . "</ph4>";
        wp_nav_menu(
          array(
            'theme_location'  => 'footer_nav',
            'menu_class'      => '',
            'menu_id'         => 'fnav',
            'container'       => 'nav',
            'items_wrap'      => '<ul id="footer-nav" class="%2$s">%3$s</ul>'
          )
        );
        echo '</div>';
      } //if footer_nav
      ?>

    <!-- <div id="footer-cont-content" class="gr4"> -->
    <div id="footer-cont-content">
      <div id="footer-gnav-container" class="gnav-container">
        <ul id="footer-gnav-ul" class="clearfix">
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20"><a href="https://a-inbound.com/company/">会社概要</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20"><a href="https://a-inbound.com/law/">特定商取引法の表記</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-21"><a href="https://a-inbound.com/privacy/">プライバシーポリシー</a></li>
        </ul>
      </div>
    </div>

          </div>
        </div>
        <div class="gr6">
          <div class="row">
        <?php
         $facebook_page_url = get_option('facebook_page_url');
         if(isset($facebook_page_url) && $facebook_page_url !== ''){
        ?>
        <div id="footer-facebook" class="gr12 text-right">
            <div class="fb-page" data-href="<?php echo $facebook_page_url;?>" data-width="500" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $facebook_page_url;?>"><a href="<?php echo $facebook_page_url;?>"><?php echo get_option('site_name');?></a></blockquote></div></div>
        </div>
        <?php } ?>
          </div>
        </div>
      </div>



    </div><!-- /wrap -->
  </div><!-- /footer-01 -->
  <div class="footer-02">
    <div class="wrap">
      <p class="footer-copy">
        © Copyright <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. All rights reserved.
      </p>
    </div><!-- /wrap -->
  </div><!-- /footer-02 -->
  <?php
  // }
  ?>
</footer>

<a href="#" class="pagetop"><span><i class="fa fa-angle-up"></i></span></a>
<?php wp_footer(); ?>

<script>
(function($){

$(function() {
    $("#header-fnav").hide();
  $("#header-fnav-area").hover(function(){
    $("#header-fnav").fadeIn('fast');
  }, function(){
    $("#header-fnav").fadeOut('fast');
  });
});


// グローバルナビ-サブメニュー
$(function(){
  $(".sub-menu").css('display', 'none');
  $("#gnav-ul li").hover(function(){
    $(this).children('ul').fadeIn('fast');
  }, function(){
    $(this).children('ul').fadeOut('fast');
  });
});

// トップページメインビジュアル
$(function(){
  h = $(window).height();
  hp = h * .3;
  //$('#main_visual').css('height', h + 'px');
  $('#main_visual .wrap').css('padding-top', hp + 'px');
});

$(function(){
	if(window.innerWidth < 768) {
  h = $(window).height();
  hp = h * .2;
  //$('#main_visual').css('height', h + 'px');
  $('#main_visual .wrap').css('padding-top', hp + 'px');
	}
});

// sp-nav
$(function(){
  var header_h = $('#header').height();
  $('#gnav-sp').hide();

    $(window).resize(function(){
      var w = $(window).width();
      var x = 991;
      if (w >= x) {
          $('#gnav-sp').hide();
      }
  });

  $('#gnav-sp').css('top', header_h);
  $('#header-nav-btn a').click(function(){
    $('#gnav-sp').slideToggle();
    $('body').append('<p class="dummy"></p>');
  });
  $('body').on('click touchend', '.dummy', function() {
    $('#gnav-sp').slideUp();
    $('p.dummy').remove();
    return false;
  });
});

})(jQuery);

</script>


</body>
</html>
