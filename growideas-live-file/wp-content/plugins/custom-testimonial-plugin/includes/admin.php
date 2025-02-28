<?php
global $wpdb;
$table_name = $wpdb->prefix . 'ctp_testimonials';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if (isset($_POST['delete'])) {
        // Delete the testimonial if the 'delete' button was clicked
        $wpdb->delete($table_name, ['id' => $id]);
    } else {
        // Otherwise, handle the visibility update
        $visibility = isset($_POST['visibility']) && $_POST['visibility'] === 'on' ? 1 : 0;
        $wpdb->update($table_name, ['is_visible' => $visibility], ['id' => $id]);
    }
}

$testimonials = $wpdb->get_results("SELECT * FROM $table_name");
?>

<div class="wrap">
    <h1>Manage Testimonials</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>City</th>
                <th>Testimonial</th>
                <th>Visible</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testimonials as $testimonial) : ?>
                <tr>
                    <!-- Display the testimonial image -->
                    <td>
                        <?php if (!empty($testimonial->photo_url)) : ?>
                            <img src="<?php echo esc_url($testimonial->photo_url); ?>" alt="<?php echo esc_attr($testimonial->name); ?>" style="width: 50px; height: 50px; border-radius: 50%;">
                        <?php else : ?>
                            <span>No image</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo esc_html($testimonial->name); ?></td>
                    <td><?php echo esc_html($testimonial->role); ?></td>
                    <td><?php echo esc_textarea($testimonial->testimonial); ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $testimonial->id; ?>">
                            <input type="checkbox" name="visibility" <?php checked($testimonial->is_visible, 1); ?> onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                            <input type="hidden" name="id" value="<?php echo $testimonial->id; ?>">
                            <button type="submit" name="delete" class="button button-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
