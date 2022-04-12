<?php

function get_page_slug($page_id) {
    $page = get_page($page_id);
    return $page->post_name;
}
 
?>