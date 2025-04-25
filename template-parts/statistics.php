<?php
// Only show stats section on pages 78 and 81
if (is_page([78, 81])) :

    // Helper function to get meta with default fallback
    $get = function($key, $default = '') {
        return get_post_meta(get_the_ID(), "_custom_stats_$key", true) ?: $default;
    };
?>
<section class="stats-section">
    <div class="stats">
        <div>
            <h2><?php echo esc_html($get('clients', 'N/A')); ?></h2>
            <p>Satisfied Clients</p>
        </div>
        <div>
            <h2><?php echo esc_html($get('hours', 'N/A')); ?></h2>
            <p>Hours of Cleaning Per Year</p>
        </div>
        <div>
            <h2><?php echo esc_html($get('eco', 'N/A')); ?></h2>
            <p>Eco-Friendly Products</p>
        </div>
        <div>
            <h2><?php echo esc_html($get('availability', 'N/A')); ?></h2>
            <p>Availability</p>
        </div>
    </div>
</section>
<?php endif; ?>
