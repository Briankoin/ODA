<?php

/**

 *

 * @package [Parent Theme]

 * @author  gaviasthemes <gaviasthemes@gmail.com>

 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License

 * 

*/

function oda_is_maintenance_mode_enabled()
{
  $value = get_option('oda_maintenance_mode', '1'); // default: on
  return (bool) $value;
}

function maintenance_mode_redirect()
{

  if (! oda_is_maintenance_mode_enabled()) {
    return;
  }

  // Allow logged-in admins/editors through
  if (is_user_logged_in() && current_user_can('manage_options')) {
    return;
  }

  // Allow wp-admin and wp-login.php
  if (
    strpos($_SERVER['REQUEST_URI'], '/wp-admin') !== false ||
    strpos($_SERVER['REQUEST_URI'], '/wp-login.php') !== false
  ) {
    return;
  }

  // (Optional) Whitelist specific IPs – add yours here
  $allowed_ips = [
    // '203.0.113.42',
  ];

  $visitor_ip = $_SERVER['REMOTE_ADDR'] ?? '';
  if (in_array($visitor_ip, $allowed_ips, true)) {
    return;
  }

  // Send correct HTTP status and show maintenance page
  http_response_code(503);
  header('Retry-After: 3600'); // hint to crawlers: try again in 1 hour

  // Option A – use a custom template file in your theme
  $template = get_stylesheet_directory() . '/maintenance.php';
  if (file_exists($template)) {
    include $template;
    exit;
  }

  // Option B – fallback inline page if template is missing
  include __DIR__ . '/maintenance-inline.php';
  exit;
}
add_action('init', 'maintenance_mode_redirect');

function oda_register_maintenance_settings_page()
{
  add_options_page(
    'Maintenance Mode',
    'Maintenance Mode',
    'manage_options',
    'oda-maintenance-mode',
    'oda_render_maintenance_settings_page'
  );
}
add_action('admin_menu', 'oda_register_maintenance_settings_page');

function oda_render_maintenance_settings_page()
{
  if (! current_user_can('manage_options')) {
    return;
  }

  if (isset($_POST['oda_maintenance_mode_submit'])) {
    check_admin_referer('oda_maintenance_mode_save');

    $enabled = isset($_POST['oda_maintenance_mode']) ? '1' : '0';
    update_option('oda_maintenance_mode', $enabled);

    echo '<div class="updated"><p>Maintenance mode settings saved.</p></div>';
  }

  $enabled = oda_is_maintenance_mode_enabled();
  ?>
  <div class="wrap">
    <h1>Maintenance Mode</h1>
    <form method="post">
      <?php wp_nonce_field('oda_maintenance_mode_save'); ?>
      <table class="form-table" role="presentation">
        <tr>
          <th scope="row">Enable maintenance mode</th>
          <td>
            <label>
              <input name="oda_maintenance_mode" type="checkbox" value="1" <?php checked($enabled); ?> />
              Take the site offline for visitors
            </label>
          </td>
        </tr>
      </table>
      <?php submit_button('Save Changes', 'primary', 'oda_maintenance_mode_submit'); ?>
    </form>
  </div>
  <?php
}

function conult_child_scripts()
{

  wp_enqueue_style('conult-parent-style', get_template_directory_uri() . '/style.css');

  wp_enqueue_style('conult-child-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'conult_child_scripts', 9999);

function custom_archive_title($title)
{
  if (is_post_type_archive('portfolio')) {
    $title = 'Projects';
  }
  return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');
