<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Facebook Comments
 *
 * Facebook Comments is a CodeIgniter library which makes it easy to put Facebook Comments on every page
 *
 * @package		Facebook Comments
 * @version		1.0
 * @author 		W. Kristianto <krist@momonimo.com>
 * @copyright 	Copyright (c) 2011, W. Kristianto
 * @link		https://github.com/Kristories/Facebook-Comments
 */
class Fb_comments {
    public function create() {
        echo '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=1377843695771445";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>';
    }

    public function create_like() {
        echo '<div class="fb-like"></div>';
    }

    public function create_comment($page, $num_post, $width) {
        echo '<fb:comments href="' . base_url() . '' . $page . '" num_posts="' . $num_post . '" width="' . $width . '">
				</fb:comments>';
    }

}
