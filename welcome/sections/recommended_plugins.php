<?php
$viral_times_free_plugins = $this->free_plugins;

if (!empty($viral_times_free_plugins)) {
    ?>
    <h3><?php echo esc_html__('Recommended Plugins', 'viral-times'); ?></h3>
    <p><?php echo esc_html__('Please install these free plugins. These plugins are complementary that adds more features to the theme.', 'viral-times'); ?></p>
    <div class="recomended-plugin-wrap">
        <?php
        foreach ($viral_times_free_plugins as $viral_times_plugin) {
            $viral_times_slug = $viral_times_plugin['slug'];
            $viral_times_name = $viral_times_plugin['name'];
            $viral_times_filename = $viral_times_plugin['filename'];
            $viral_times_thumb = $viral_times_plugin['thumb_path'];
            ?>
            <div class="recommended-plugins">
                <div class="plugin-image">
                    <img src="<?php echo esc_url($viral_times_thumb) ?>" />
                </div>

                <div class="plugin-title-wrap">
                    <div class="plugin-title">
                        <?php echo esc_html($viral_times_name); ?>
                    </div>

                    <div class="plugin-btn-wrapper">
                        <?php if ($this->check_plugin_installed_state($viral_times_slug, $viral_times_filename) && !$this->check_plugin_active_state($viral_times_slug, $viral_times_filename)): ?>
                            <a target="_blank" href="<?php echo esc_url($this->plugin_generate_url('active', $viral_times_slug, $viral_times_filename)) ?>" class="button button-primary"><?php esc_html_e('Activate', 'viral-times'); ?></a>
                        <?php elseif ($this->check_plugin_installed_state($viral_times_slug, $viral_times_filename)):
                            ?>
                            <button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e('Installed', 'viral-times'); ?></button>
                        <?php else:
                            ?>
                            <a target="_blank" class="install-now button-primary" href="<?php echo esc_url($this->plugin_generate_url('install', $viral_times_slug, $viral_times_filename)) ?>">
                                <?php esc_html_e('Install Now', 'viral-times'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <?php
}