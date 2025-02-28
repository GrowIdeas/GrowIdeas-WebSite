<form id="testimonialForm" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="City">City:</label>
    <input type="text" id="role" name="role">

    <label for="testimonial">Testimonial:</label>
    <textarea id="testimonial" name="testimonial" required></textarea>

    <label for="photo">Upload Photo:</label>
    <input type="file" id="photo" name="photo" accept="image/*" required>

    <button type="submit">Submit Testimonial</button>
</form>

<script>
    jQuery(document).ready(function($) {
        $('#testimonialForm').on('submit', function(e) {
            e.preventDefault();
            
            // Create FormData object to handle file uploads
            var formData = new FormData(this);  // 'this' refers to the form element

            formData.append('action', 'ctp_submit_testimonial');  // Add the action field

            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",  // WordPress AJAX handler
                type: "POST",
                dataType: "json",
                data: formData,  // Send the FormData object
                contentType: false, // Don't set content-type manually (handled by FormData)
                processData: false, // Don't process the data (handled by FormData)
                success: function(response) {
                    if (response.success) {
                        alert('Testimonial submitted successfully!');
                        window.location.href = response.data.redirect_url; // Redirect to homepage
                    } else {
                        alert('Failed to submit testimonial. Please try again.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);  // Log the error response for debugging
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
