<div id="testimonial-section">
    <div class="testimonial-navigation prev">&#10094;</div>
    <?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'ctp_testimonials';
    $testimonials = $wpdb->get_results("SELECT * FROM $table_name WHERE is_visible = 1");
    if (!empty($testimonials)) :
        foreach ($testimonials as $testimonial) :
            ?>
            <div class="testimonial-card">
                <div class="testimonial-photo">
                    <img src="<?php echo esc_url($testimonial->photo_url); ?>" alt="Profile Photo">
                </div>
                <h3><?php echo esc_html($testimonial->name); ?></h3>
                <p class="role"><?php echo esc_html($testimonial->role); ?></p>
                <p class="testimonial-text"><?php echo esc_textarea($testimonial->testimonial); ?></p>
            </div>     
    <?php endforeach; ?>
    <?php else : ?>
        <p>No testimonials available.</p>
    <?php endif; ?>
    <div class="testimonial-navigation next">&#10095;</div>
</div>
