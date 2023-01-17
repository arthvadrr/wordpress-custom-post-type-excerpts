<?php
$form_action = admin_url() . 'tools.php?page=post-excerpts';
$post_types = get_post_types();
$option_prefix = 'cpte_';

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
  <?php print_r($post_types) ?>
  <h1>hello world</h1>
  <form action="<?php echo $form_action; ?>" method="post">
    <h2>Add Data Export Request</h2>
    <table class="form-table">
      <tbody>
        <?php
        foreach ($post_types as $type) :
          if (!in_array($type, $ignored_post_types)) :
            $length = 55;
            $option_name = $option_prefix . $type;
            $option = get_option($option_name);

            if ($option) {
              $length = $option;
            } else {
              add_option($option_name, $length);
            }
        ?>
            <tr>
              <th scope="row">
                <label for="<?php echo $type ?>"><?php echo $type ?></label>
              </th>
              <td>
                <input type="text" required="" class="regular-text ltr" id="username_or_email_for_privacy_request" name="username_or_email_for_privacy_request" value="<?php echo $length; ?>">
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
      <input type="submit" name="submit" id="submit" class="button" value="Send Request">
    </p>
  </form>
</section>