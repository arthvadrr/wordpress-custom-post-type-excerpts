<?php
$form_action = admin_url() . 'tools.php?page=post-excerpts';
$post_types = get_post_types();
$option_prefix = 'cpte_excerpt_length__';
$success_notice_rendered = false;
$updated_count = 0;

$ignored_post_types = [
  'attachment',
  'revision',
  'nav_menu_item',
  'custom_css',
  'customize_changeset',
  'oembed_cache',
  'user_request',
  'wp_block',
  'wp_template',
  'wp_template_part',
  'wp_global_styles',
  'wp_navigation'
]
?>
<section class="wrap">
  <p>
  <h1>Set Excerpt Lengths</h1>
  <h2>Set the new excerpt length for each post type.</h2>
  </p>
  <form action="<?php echo $form_action; ?>" method="post">
    <table class="form-table">
      <tbody>
        <?php
        foreach ($post_types as $type) :

          if ($updated_count === 1 && !$success_notice_rendered) : ?>
            <div id="setting-error-settings_updated" class="notice notice-success settings-error">
              <p><strong>Settings saved.</strong></p>
            </div>
          <?php
            $success_notice_rendered = true;
          endif;

          if (!in_array($type, $ignored_post_types)) :
            $length = 55;
            $length_input_name = $option_prefix . $type;
            $updated = isset($_POST[$length_input_name]);
            $option_name = $option_prefix . $type;
            $option = get_option($option_name);

            if ($updated) {
              $length = $_POST[$length_input_name];
              update_option($option_name, $length);
            } else {
              if ($option) {
                $length = $option;
              } else {
                add_option($option_name, $length);
              }
            }

            if (!$length) $length = 0;
          ?>
            <tr>
              <th scope="row">
                <label for="<?php echo $type ?>"><?php echo $type ?></label>
              </th>
              <td>
                <input type="text" id="" name="<?php echo $length_input_name; ?>" value="<?php echo $length; ?>">
                <?php if ($updated && $length !== $option) :
                  $updated_count++;
                ?>
                  <strong style="color: #00a32a;" class="fade-out">Updated!</strong>
                <?php endif; ?>
              </td>
            </tr>
        <?php
          endif;
        endforeach;
        ?>
      </tbody>
    </table>
    <?php wp_nonce_field($form_action) ?>
    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button" value="Save">
      <?php if ($updated_count === 0 && isset($_POST['submit'])) : ?>
        <span class="fade-out">(No settings were changed)</span>
      <?php endif; ?>
    </p>
  </form>
</section>