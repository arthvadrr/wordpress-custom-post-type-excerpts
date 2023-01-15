<?php
$form_action = admin_url() . 'tools.php?page=post-excerpts';
$post_types = get_post_types();

$excerpts = $wpdb->get_results(
  "SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish'
  AND post_type='post' ORDER BY comment_count DESC LIMIT 0,4"
)
?>

<section class="wrap">
  <?php print_r($post_types) ?>
  <h1>hello world</h1>
  <form action="<?php echo $form_action; ?>" method="post">
    <h2>Add Data Export Request</h2>
    <table class="form-table">
      <tbody>
        <?php foreach ($post_types as $type) : ?>
          <tr>
            <th scope="row">
              <label for="<?php echo $type ?>"><?php echo $type ?></label>
            </th>
            <td>
              <input type="text" required="" class="regular-text ltr" id="username_or_email_for_privacy_request" name="username_or_email_for_privacy_request">
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <?php wp_nonce_field($form_action) ?>
    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button" value="Send Request">
    </p>
  </form>
</section>