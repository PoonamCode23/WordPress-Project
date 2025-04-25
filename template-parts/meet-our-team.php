<section id="team" class="team wrapper">
    <div class="team-introduction">
        <h2>Meet Our Team</h2>
        <p>We are the leaders of cleaning services in Australia. With over 15 years of expertise.</p>
    </div>

    <div class="team-photo wrapper">
        <?php
        // Get the custom fields for Team Member 1
        $team_one_name = get_post_meta(78, '_team_one_name', true);
        $team_one_position = get_post_meta(78, '_team_one_position', true);
        $team_one_image = get_post_meta(78, '_team_one_image', true);

        // Get the custom fields for Team Member 2
        $team_two_name = get_post_meta(78, '_team_two_name', true);
        $team_two_position = get_post_meta(78, '_team_two_position', true);
        $team_two_image = get_post_meta(78, '_team_two_image', true);
        ?>
        
        <div class="team-one">
            <?php if (!empty($team_one_image)) : ?>
                <img src="<?php echo esc_url($team_one_image); ?>" alt="Team Member">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/default-team-image.png" alt="Default Team Member">
            <?php endif; ?>
            <h2><?php echo esc_html($team_one_name); ?></h2>
            <p><?php echo esc_html($team_one_position); ?></p>
        </div>

        <div class="team-two">
            <?php if (!empty($team_two_image)) : ?>
                <img src="<?php echo esc_url($team_two_image); ?>" alt="Team Member">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/default-team-image.png" alt="Default Team Member">
            <?php endif; ?>
            <h2><?php echo esc_html($team_two_name); ?></h2>
            <p><?php echo esc_html($team_two_position); ?></p>
        </div>
    </div>
</section>
