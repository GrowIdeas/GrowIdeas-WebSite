jQuery(document).ready(function($) {
    let currentIndex = 0;
    const testimonials = $('.testimonial-card');
    const totalTestimonials = testimonials.length;

    function showTestimonial(index) {
        testimonials.removeClass('active'); 
        
        if (index >= totalTestimonials) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = totalTestimonials - 1;
        }
        
        testimonials.eq(currentIndex).addClass('active');
    }

    $('.next').click(function() {
        currentIndex++;
        showTestimonial(currentIndex);
    });

    $('.prev').click(function() {
        currentIndex--;
        showTestimonial(currentIndex);
    });

    showTestimonial(currentIndex);

    /*setInterval(function() {
        currentIndex++;
        showTestimonial(currentIndex);
    }, 5000);*/
});