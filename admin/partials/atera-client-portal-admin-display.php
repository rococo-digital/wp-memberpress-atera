<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://rococodigital.co.uk
 * @since      0.1
 *
 * @package    Atera_Client_Portal
 * @subpackage Atera_Client_Portal/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container">
<div class="box">

<h1 class="title is-3">Atera Control Panel Settings</h1>
<form method="post" action="options.php">
<?php
settings_fields('atera-admin-settings');
do_settings_sections('atera-admin-settings');
?>
  <div class="field">
    <label class="label" for="inputAteraAPI">API key</label>
    <input class="input" type="password" value="<?php echo get_option('atera-api-key') ?>" name="atera-api-key" class="form-control" id="inputAteraAPI" aria-describedby="apiInputHelp">
    <small id="apiInputHelp" class="form-text text-muted">Keep your key secure.</small>
  </div>
  <div class="field">
  <div class="control">
    <button class="button is-link" type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
</form>
</div>



<div class="box">
<h4 class="title is-4">Knowledgebase Controls</h4>
<div class="columns">
<div class="column is-half">
<form action="" method="post">
<div class="field is-grouped ">
  <div class="control">
    <button class="button is-link" type="submit" name="refresh_knowledgebase">Refresh Knowledgebase</button>
  </div>
  <?php
if (isset($_POST['refresh_knowledgebase'])) {
    ?><div class="control"><div class="notification is-success"><p>Knowledgebase updated</p></div></div>
        <?php
}?>
</div>
</form>
</div>

<div class="column is-half">
<form action="" method="post">
<div class="field is-grouped">
  <div class="control">
    <button class="button is-danger" type="submit" name="delete_knowledgebase">Delete Knowledgebase</button>
  </div>
  <?php
if (isset($_POST['delete_knowledgebase'])) {
    ?><div class="control"><div class="notification is-success"><p>Knowledgebase deleted</p></div></div>
        <?php
}?>
</div>
</form>
</div>
</div>
</div>
</div>
<?php

//Get knowledgebase articles
if (isset($_POST['refresh_knowledgebase'])) {
    updateKnowledgebase();
}

if (isset($_POST['delete_knowledgebase'])) {
    deleteAllKnowledgebasePosts();
}

function deleteAllKnowledgebasePosts()
{
    $allKnowledgebases = get_posts(array('post_type' => 'atera_knowledgebase', 'numberposts' => 100));

    foreach ($allKnowledgebases as $singlePost) {
        wp_delete_post($singlePost->ID, true);
    }
}

function updateKnowledgebase()
{
    $atera_api_key = get_option('atera-api-key');
    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://app.atera.com/api/v3/knowledgebases');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'X-Api-Key:' . $atera_api_key;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = json_decode(curl_exec($ch));
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    foreach ($result->items as $item) {
        $tags = explode(",", $item->KBKeywords);

        $data = array(
            'post_title' => $item->KBProduct,
            'post_content' => $item->KBContext,
            'tags_input' => array($tags),
            'post_status' => 'publish',
            'post_type' => 'atera_knowledgebase',
        );

        //insert post into database and retrieve the ID
        $post = wp_insert_post($data);

        //capture the ID of the post
        if ($post && !is_wp_error($post)) {
            $newPostId = $post;

            add_post_meta($newPostId, "KBID", $item->KBID);
            add_post_meta($newPostId, "KBTimestamp", $item->KBTimestamp);
            add_post_meta($newPostId, "KBLastModified", $item->KBLastModified);
            add_post_meta($newPostId, "KBPriority", $item->KBPriority);
            add_post_meta($newPostId, "KBStatus", $item->KBStatus);
            add_post_meta($newPostId, "KBIsPrivate", $item->KBIsPrivate);
        }
    }
}

// $atera_api_key = get_option('atera-api-key');

// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://app.atera.com/api/v3/alerts');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// $headers = array();
// $headers[] = 'Accept: application/json';
// $headers[] = 'X-Api-Key: ' . $atera_api_key;
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = json_decode(curl_exec($ch));
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }

// echo '<h2>' . 'Alerts' . '</h2>';
// echo '<div class="container"><div class="columns is-multiline">';
// foreach($result->items as $item){
//     echo '<div class="column is-one-quarter">';
//     echo '<div class="card" style="width: 18rem;">';
//         echo '<div class="card-body">';
//             echo '<h5 class="card-title">' . $item->Title . ' - ' . $item->DeviceName . '</h5>';
//             echo '<h6 class="card-subtitle mb-2 text-muted">' . $item->Severity . '</h6>';
//             echo '<p class="card-text">' . $item->AlertMessage . '</p>';
//             echo '<a href="#" class="card-link">' . 'doesnt work' . '</a>';
//         echo '</div>';
//     echo '</div>';
//     echo '</div>';
// }

// echo '</div></div>';

// curl_close($ch);

?>