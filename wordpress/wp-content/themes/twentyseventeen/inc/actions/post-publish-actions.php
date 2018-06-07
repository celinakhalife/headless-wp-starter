
<?php

function post_published_send_email($post_id)
{

    $post_title = get_the_title($post_id);
    $post_url = get_permalink($post_id);
    $subject = 'A post has been published';
    $message = "A post has been published on your website:\n\n";
    $message .= $post_title . ": " . $post_url;

// Send email to admin.
    wp_mail('celina.khalife@gmail.com', $subject, $message);
}

add_action('publish_post', 'post_published_send_email');
