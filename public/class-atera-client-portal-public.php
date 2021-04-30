<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://rococodigital.co.uk
 * @since      0.1
 *
 * @package    Atera_Client_Portal
 * @subpackage Atera_Client_Portal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Atera_Client_Portal
 * @subpackage Atera_Client_Portal/public
 * @author     Matt Jones <matt@rococodigital.co.uk>
 */
class Atera_Client_Portal_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    0.1
     * @access   private
     * @var      string    $Atera_Client_Portal    The ID of this plugin.
     */
    private $Atera_Client_Portal;

    /**
     * The version of this plugin.
     *
     * @since    0.1
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    0.1
     * @param      string    $Atera_Client_Portal       
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($Atera_Client_Portal, $version)
    {

        $this->Atera_Client_Portal = $Atera_Client_Portal;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    0.1
     */
    public function enqueue_styles()
    {

        wp_enqueue_style($this->Atera_Client_Portal, plugin_dir_url(__FILE__) . 'css/atera-client-portal-public.css', array(), $this->version, 'all');
        wp_enqueue_style('bulmacss', plugin_dir_url(__FILE__) . 'css/bulma.min.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    0.1
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script($this->Atera_Client_Portal, plugin_dir_url(__FILE__) . 'js/atera-client-portal-public.js', array('jquery'), $this->version, false);

    }

    /**
     * Knoledgebase custom post type
     *
     * @since    0.1
     */
    public function knowledgebase_post_type_init(){

        $labels = array(
            'name'                  => _x( 'Knowledgebase', 'Post type general name', 'knowledgebase' ),
            'singular_name'         => _x( 'Knowledgebase', 'Post type singular name', 'knowledgebase' ),
            'menu_name'             => _x( 'Knowledgebases', 'Admin Menu text', 'knowledgebase' ),
            'name_admin_bar'        => _x( 'Knowledgebase', 'Add New on Toolbar', 'knowledgebase' ),
            'add_new'               => __( 'Add New', 'knowledgebase' ),
            'add_new_item'          => __( 'Add New Knowledgebase', 'knowledgebase' ),
            'new_item'              => __( 'New Knowledgebase', 'knowledgebase' ),
            'edit_item'             => __( 'Edit Knowledgebase', 'knowledgebase' ),
            'view_item'             => __( 'View Knowledgebase', 'knowledgebase' ),
            'all_items'             => __( 'All Knowledgebases', 'knowledgebase' ),
            'search_items'          => __( 'Search Knowledgebases', 'knowledgebase' ),
            'parent_item_colon'     => __( 'Parent Knowledgebases:', 'knowledgebase' ),
            'not_found'             => __( 'No knowledgebase found.', 'knowledgebase' ),
            'not_found_in_trash'    => __( 'No knowledgebase found in Trash.', 'knowledgebase' ),
            'featured_image'        => _x( 'Article Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'Article archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'insert_into_item'      => _x( 'Insert into article', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this article', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter knowledgebase list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'Knowledgebase list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'Knowledgebase list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'knowledgebase' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        );
     
        register_post_type( 'atera_knowledgebase', $args );
    }

	/**
     * Create new atera contact
     *
     * @since    0.1
     */
    public function add_atera_contact($user_id)
    {
		$userdata = get_userdata($user_id);
		$atera_api_key = get_option('atera-api-key');
		$ateraCustomerId = get_user_meta($user_id, 'ateraCustomerId', true);
		$contact = json_encode(array('CustomerID' => $ateraCustomerId, 'Email' => $userdata->user_email));
		
		// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://app.atera.com/api/v3/contacts');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $contact);

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Accept: application/json';
		$headers[] = 'X-Api-Key: ' . $atera_api_key;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = json_decode(curl_exec($ch));

		//Capture the ID sent from Atera for the new user and store it in user meta
		update_user_meta($user_id, 'ateraContactId', $result->ActionID);

		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
	}

	/**
     * Create new atera contact
     *
     * @since    0.1
     */
    public function add_atera_user($user_id)
    {
		$userdata = get_userdata($user_id);
		$atera_api_key = get_option('atera-api-key');

		$customer = json_encode(array('CustomerName' => $userdata->user_login, 'CreatedOn' => $userdata->user_registered));

		// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://app.atera.com/api/v3/customers');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $customer);

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Accept: application/json';
		$headers[] = 'X-Api-Key: ' . $atera_api_key;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = json_decode(curl_exec($ch));

		//Capture the ID sent from Atera for the new user and store it in user meta
		update_user_meta($user_id, 'ateraCustomerId', $result->ActionID);
	
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
	}

    /**
     * Create new atera user
     *
     * @since    0.1
     */
    public function add_new_atera_user($user_id)
    {
        //Create the customer
        $this->add_atera_user($user_id);

		//Give the customer a contact email
		$this->add_atera_contact($user_id);
    }



    private function createTicketForm()
    {
        ?>
		<form action="" method="post">
		<div class="field">
				<label class="label">Title</label>
				<div class="control">
					<input class="input" type="text" placeholder="Ticket title" name="ticket_title"></input>
				</div>
			</div>
			<div class="field">
				<label class="label">Reply</label>
				<div class="control">
					<textarea class="textarea" placeholder="Your comment" name="ticket_description"></textarea>
				</div>
			</div>
			<div class="control">
				<button type="submit" class="button is-link">Create ticket</button>
			</div>
		</form>
		<?php
	}

    private function createNewTicket($title, $description, $endUserId)
    {

        $atera_api_key = get_option('atera-api-key');
	
        $ticket = json_encode(array('TicketTitle' => $title, 'Description' => $description, 'EndUserID' => $endUserId));

        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://app.atera.com/api/v3/tickets');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $ticket);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        $headers[] = 'X-Api-Key: ' . $atera_api_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = json_decode(curl_exec($ch));

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            $info = curl_getinfo($ch);
            if (empty($info['http_code'])) {
                die("No HTTP code was returned");
            } else if ($info['http_code'] == 201) {
                ?>

				<div class="notification is-success">
					Ticket created successfully

				</div>
			<?php
			} else {
                ?>
					<div class="notification is-danger">
						<?php echo 'Failed to create ticket, error: ' . $info['http_code'] ?>
					</div>
				<?php
			}
        }
        curl_close($ch);

    }

    function getTicket($ticketId){
        // Get single ticket
        $atera_api_key = get_option('atera-api-key');
    
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'https://app.atera.com/api/v3/tickets/' . $ticketId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'X-Api-Key: ' . $atera_api_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $result = json_decode(curl_exec($ch));
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
    
        curl_close($ch);
        return $result;
    }

    private function display_atera_ticket($ticketId){

        $ticket = $this->getTicket($ticketId);

        ?>
        
        <div class="block">
        <h2 class="title is-2" ><?php echo $ticket->TicketTitle ?></h2>
        
        <article class="message is-warning">
        <div class="message-header">Your last comment:</div>
            <div class="message-body"><?php echo $ticket->LastEndUserComment ?></div>
        </article>
        
        <?php
        if ($ticket->LastTechnicianComment != "") {
            ?>
        <article class="message is-info">
            <div class="message-header">Technicians last comment:</div>
            <div class="message-body"><?php echo $ticket->LastTechnicianComment ?>
        </div>
        </article>
        <?php
        }
        ?>
        
        </div>
        </div>
       
        <?php
    }


    /**
     * Add tabs to memberpress account page
     *
     * @since    0.1
     */
    public function mepr_add_some_tabs($action)
    {
        $support_active = (isset($_GET['action']) && $_GET['action'] == 'ticketing') ? 'mepr-active-nav-tab' : '';
        ?>
		  <span class="mepr-nav-item ticketing <?php echo $support_active; ?>">
			<a href="?action=ticketing">Ticketing</a>
		  </span>
		  <?php
        $knowledgebase_active = (isset($_GET['action']) && $_GET['action'] == 'knowledgebase') ? 'mepr-active-nav-tab' : '';
        ?>
        <span class="mepr-nav-item knowledgebase <?php echo $knowledgebase_active; ?>">
            <a href="?action=knowledgebase">Knowledgebase</a>
        </span>
        <?php

    }

    /**
     * Add content to tabs on memberpress account page
     *
     * @since    0.1
     */
    public function mepr_add_tabs_content($action)
    {
        //Check user is logged in
        if (!get_current_user_id()) {
            return;
        }

        $ateraCustomerId = get_user_meta(get_current_user_id(), 'ateraCustomerId', true);
		$ateraContactId = get_user_meta(get_current_user_id(), 'ateraContactId', true);

        if (isset($_POST['ticket_description']) && isset($_POST['ticket_title'])) {
            $this->createNewTicket($_POST['ticket_title'], $_POST['ticket_description'], $ateraContactId);
        }

        // Check whether the button has been pressed or ticket submitted
        if (isset($_POST['view_ticket_button'])) {
            $ticketId = $_POST['ticket_id'];
            $this->display_atera_ticket($ticketId);
            // require_once 'partials/atera-client-portal-ticket-display.php';
        }

        $atera_api_key = get_option('atera-api-key');

        if ($action == 'knowledgebase') {
            ?>
            <h2>Knowledgebase</h2>
            
            <?php
            if ( function_exists( 'search_live' ) ) {
                echo search_live( array( 
                    'limit' => 30,
                    'show_description' => 'yes',
                    'thumbnails' => 'no',
                    'post_types' => array(['atera_knowledgebase']),
                ) );
            }
   
           

        }

        // Add content to ticketing tab
        if ($action == 'ticketing') {
            

            // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://app.atera.com/api/v3/tickets?customerId=' . $ateraCustomerId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'X-Api-Key: ' . $atera_api_key;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = json_decode(curl_exec($ch));
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }

            echo '<h2 class="title is-4">' . 'Current Tickets' . '</h2>';
            echo '<table class="table has-text-left"><thead><tr>';
            echo '<th class="has-text-left"><abbr title="ID">' . 'ID' . '</abbr></th>';
            echo '<th class="has-text-left"><abbr title="Title">' . "Title" . '</abbr></th>';
            echo '<th class="has-text-left"><abbr title="Status">' . "Status" . '</abbr></th>';
            echo '<th class="has-text-left"><abbr title="Comment">' . "Comment" . '</abbr></th>';
            echo '<th class="has-text-left"><abbr title="">' . "" . '</abbr></th>';
            echo '</tr></thead>';
            foreach ($result->items as $item) {

                echo '<tbody><tr>';
                echo '<td>' . $item->TicketID . '</td>';
                echo '<td>' . $item->TicketTitle . '</td>';
                echo '<td>' . $item->TicketStatus . '</td>';
                echo '<td>' . $item->FirstComment . '</td>';
                echo '<td><form method="post" action="">';
                echo '<input type="hidden" name="ticket_id" value="' . $item->TicketID . '"> <button type="submit" name="view_ticket_button">View Ticket</button>';
                echo '</div></form></td></tr>';
            }
            echo '</table>';
            curl_close($ch);

            $this->createTicketForm();
        }

    }

}
