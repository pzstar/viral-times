<?php
$viral_times_steps = $this->setup_steps();
$viral_times_done = count(wp_list_filter($viral_times_steps, array('done' => true)));
$viral_times_percent = round(100 * $viral_times_done / count($viral_times_steps));
?>
<div class="welcome-grid welcome-grid-start">
    <div class="welcome-card welcome-setup-checklist">
        <div class="welcome-setup-head">
            <div class="welcome-ring" style="--welcome-progress:<?php echo absint($viral_times_percent); ?>" role="progressbar" aria-valuemin="0" aria-valuemax="<?php echo count($viral_times_steps); ?>" aria-valuenow="<?php echo absint($viral_times_done); ?>" aria-label="<?php esc_attr_e('Setup progress', 'viral-times'); ?>">
                <span><?php echo absint($viral_times_percent); ?>%</span>
            </div>
            <div>
                <h3><?php esc_html_e('Set Up Your Website', 'viral-times'); ?></h3>
                <p class="welcome-setup-count"><?php /* translators: 1: steps done, 2: all steps */ printf(esc_html__('%1$d of %2$d done', 'viral-times'), $viral_times_done, count($viral_times_steps)); ?></p>
            </div>
        </div>

        <ol class="welcome-setup-steps">
            <?php foreach ($viral_times_steps as $viral_times_step) { ?>
                <li class="<?php echo $viral_times_step['done'] ? 'is-done' : 'is-todo'; ?>">
                    <span class="welcome-setup-mark dashicons <?php echo $viral_times_step['done'] ? 'dashicons-yes' : ''; ?>" aria-hidden="true"></span>
                    <div class="welcome-setup-text">
                        <strong><?php echo esc_html($viral_times_step['title']); ?></strong>
                        <span class="screen-reader-text"><?php echo $viral_times_step['done'] ? esc_html__('(done)', 'viral-times') : esc_html__('(to do)', 'viral-times'); ?></span>
                        <p><?php echo esc_html($viral_times_step['text']); ?></p>
                    </div>
                    <?php
                    if ($viral_times_step['url']) {
                        echo '<a class="button' . ($viral_times_step['done'] ? '' : ' button-primary') . '" href="' . esc_url($viral_times_step['url']) . '">' . ($viral_times_step['done'] ? esc_html__('Change', 'viral-times') : esc_html__('Set up', 'viral-times')) . '</a>';
                    } elseif (!$viral_times_step['done']) {
                        echo $this->generate_hdi_install_button();
                    }
                    ?>
                </li>
            <?php } ?>
        </ol>
    </div>

    <div class="welcome-card welcome-demo-import">
        <div class="welcome-demo-thumb">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.jpg'); ?>" alt="<?php /* translators: %s: theme name */ printf(esc_attr__('%s Demo', 'viral-times'), $this->theme_name); ?>">
            <a href="https://demo.hashthemes.com/viral-times/" target="_blank" class="welcome-demo-view"><span class="dashicons dashicons-external" aria-hidden="true"></span><?php esc_html_e('View Demo', 'viral-times'); ?></a>
        </div>
        <div class="welcome-card-body">
            <h3><?php esc_html_e('Start From a Demo', 'viral-times'); ?></h3>
            <p><?php esc_html_e('Import a complete demo website, with its content and settings, in a single click, then replace the content with your own.', 'viral-times'); ?></p>
            <?php echo $this->generate_hdi_install_button(); ?>
            <p class="welcome-small"><a href="https://hashthemes.com/documentation/viral-times-documentation/#Import-Demo-Content" target="_blank"><?php esc_html_e('How the demo importer works', 'viral-times'); ?></a></p>
        </div>
    </div>
</div>

<div class="welcome-block">
    <div class="welcome-block-head">
        <h3><?php esc_html_e('Customize Your Site', 'viral-times'); ?></h3>
        <a href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php esc_html_e('Open the Customizer', 'viral-times'); ?> <span aria-hidden="true">&rarr;</span></a>
    </div>
    <div class="welcome-quick-links">
        <?php foreach ($this->quick_links() as $viral_times_link) { ?>
            <a class="welcome-quick-link" href="<?php echo esc_url($viral_times_link['url']); ?>">
                <span class="dashicons <?php echo esc_attr($viral_times_link['icon']); ?>" aria-hidden="true"></span>
                <?php echo esc_html($viral_times_link['label']); ?>
            </a>
        <?php } ?>
    </div>
</div>

<div class="welcome-block">
    <div class="welcome-block-head">
        <h3><?php esc_html_e('Build Your Front Page', 'viral-times'); ?></h3>
        <a href="https://hashthemes.com/documentation/viral-times-documentation/#Home-Page-Setup" target="_blank"><?php esc_html_e('Step-by-step guide', 'viral-times'); ?> <span aria-hidden="true">&rarr;</span></a>
    </div>
    <p class="welcome-block-intro"><?php echo esc_html__('Build the front page from the theme\'s ready-made news sections in the Customizer, or design it freely with Elementor.', 'viral-times'); ?></p>

    <div class="welcome-grid welcome-grid-2">
        <div class="welcome-card welcome-method">
            <span class="welcome-method-icon dashicons dashicons-admin-customizer" aria-hidden="true"></span>
            <h4><?php esc_html_e('With the Customizer', 'viral-times'); ?></h4>
            <ol>
                <li><?php echo sprintf(esc_html__('Go to Appearance > Customize > %s.', 'viral-times'), '<a href="' . esc_url(admin_url('customize.php?autofocus[section]=static_front_page')) . '">' . esc_html__('Homepage Settings', 'viral-times') . '</a>'); ?></li>
                <li><?php echo esc_html__('Turn on "Enable FrontPage".', 'viral-times'); ?></li>
                <li><?php echo esc_html__('Go back, open "Front Page Sections" and fill in the sections you want to show.', 'viral-times'); ?></li>
            </ol>
        </div>

        <div class="welcome-card welcome-method">
            <span class="welcome-method-icon dashicons dashicons-layout" aria-hidden="true"></span>
            <h4><?php esc_html_e('With Elementor', 'viral-times'); ?></h4>
            <ol>
                <li><?php printf(esc_html__('Install Elementor from Plugins > Add New, then Hash Elements from the %s.', 'viral-times'), '<a href="' . esc_url(admin_url('admin.php?page=viral-times-welcome&section=recommended_plugins')) . '">' . esc_html__('Recommended Plugins tab', 'viral-times') . '</a>'); ?></li>
                <li><?php echo esc_html__('Create a new page, edit it with Elementor and drag in the news widgets to design your front page.', 'viral-times'); ?></li>
                <li><?php echo sprintf(esc_html__('In Appearance > Customize > %s, choose "A static page", select your new page as the Homepage and turn off "Enable FrontPage".', 'viral-times'), '<a href="' . esc_url(admin_url('customize.php?autofocus[section]=static_front_page')) . '">' . esc_html__('Homepage Settings', 'viral-times') . '</a>'); ?></li>
            </ol>
        </div>
    </div>
</div>
