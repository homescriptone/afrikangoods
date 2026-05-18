<?php

class Afrikangoods_Requetes {

	public function init() {
		$this->register_post_type();
		$this->register_statuses();
		$this->add_myaccount_endpoint();

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post_requete', array( $this, 'save_meta' ) );
		add_filter( 'manage_requete_posts_columns', array( $this, 'admin_columns' ) );
		add_action( 'manage_requete_posts_custom_column', array( $this, 'admin_columns_content' ), 10, 2 );
		add_filter( 'manage_edit-requete_sortable_columns', array( $this, 'sortable_columns' ) );
		add_action( 'restrict_manage_posts', array( $this, 'admin_status_filter' ) );
		add_filter( 'parse_query', array( $this, 'admin_status_filter_query' ) );
		add_action( 'woocommerce_account_requetes_endpoint', array( $this, 'myaccount_content' ) );
		add_filter( 'woocommerce_account_menu_items', array( $this, 'myaccount_menu_item' ), 40 );
		add_action( 'template_redirect', array( $this, 'handle_submission' ) );
		add_action( 'admin_post_afrikangoods_requete_reply', array( $this, 'admin_handle_reply' ) );
		add_action( 'admin_post_afrikangoods_requete_delete', array( $this, 'admin_handle_delete' ) );
		add_filter( 'post_row_actions', array( $this, 'admin_row_actions' ), 10, 2 );
		add_action( 'wp_ajax_afrikangoods_requete_reply', array( $this, 'ajax_reply' ) );
		add_action( 'wp_ajax_afrikangoods_requete_delete', array( $this, 'ajax_delete' ) );
	}

	public function register_post_type() {
		$labels = array(
			'name'               => __( 'Requêtes', 'afrikangoods' ),
			'singular_name'      => __( 'Requête', 'afrikangoods' ),
			'menu_name'          => __( 'Requêtes', 'afrikangoods' ),
			'add_new'            => __( 'Nouvelle requête', 'afrikangoods' ),
			'add_new_item'       => __( 'Ajouter une requête', 'afrikangoods' ),
			'edit_item'          => __( 'Modifier la requête', 'afrikangoods' ),
			'view_item'          => __( 'Voir la requête', 'afrikangoods' ),
			'search_items'       => __( 'Rechercher des requêtes', 'afrikangoods' ),
			'not_found'          => __( 'Aucune requête trouvée.', 'afrikangoods' ),
			'not_found_in_trash' => __( 'Aucune requête dans la corbeille.', 'afrikangoods' ),
			'all_items'          => __( 'Toutes les requêtes', 'afrikangoods' ),
		);

		register_post_type( 'requete', array(
			'labels'              => $labels,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-email-alt',
			'menu_position'       => 56,
			'capabilities'        => array(
				'edit_post'          => 'manage_options',
				'read_post'          => 'manage_options',
				'delete_post'        => 'manage_options',
				'edit_posts'         => 'manage_options',
				'edit_others_posts'  => 'manage_options',
				'publish_posts'      => 'manage_options',
				'read_private_posts' => 'manage_options',
				'delete_posts'       => 'manage_options',
			),
			'map_meta_cap'        => true,
			'supports'            => array( 'title', 'author' ),
			'has_archive'         => false,
			'rewrite'             => false,
			'query_var'           => false,
		) );
	}

	public function register_statuses() {
		register_post_status( 'nouveau', array(
			'label'                     => __( 'Nouveau', 'afrikangoods' ),
			'public'                    => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Nouveau <span class="count">(%s)</span>', 'Nouveaux <span class="count">(%s)</span>', 'afrikangoods' ),
		) );
		register_post_status( 'en-cours', array(
			'label'                     => __( 'En cours', 'afrikangoods' ),
			'public'                    => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'En cours <span class="count">(%s)</span>', 'En cours <span class="count">(%s)</span>', 'afrikangoods' ),
		) );
		register_post_status( 'resolu', array(
			'label'                     => __( 'Résolu', 'afrikangoods' ),
			'public'                    => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Résolu <span class="count">(%s)</span>', 'Résolus <span class="count">(%s)</span>', 'afrikangoods' ),
		) );
	}

	public function add_meta_boxes() {
		add_meta_box(
			'requete_conversation',
			__( 'Conversation', 'afrikangoods' ),
			array( $this, 'meta_box_conversation' ),
			'requete',
			'normal',
			'high'
		);
		add_meta_box(
			'requete_details',
			__( 'Détails de la requête', 'afrikangoods' ),
			array( $this, 'meta_box_details' ),
			'requete',
			'side',
			'default'
		);
	}

	public function meta_box_details( $post ) {
		$customer_id = get_post_meta( $post->ID, '_requete_customer_id', true );
		$customer_email = get_post_meta( $post->ID, '_requete_customer_email', true );
		$customer_name = get_post_meta( $post->ID, '_requete_customer_name', true );
		?>
		<p><strong><?php esc_html_e( 'Client :', 'afrikangoods' ); ?></strong>
			<?php echo esc_html( $customer_name ? $customer_name : __( 'Inconnu', 'afrikangoods' ) ); ?>
			<?php if ( $customer_id ) : ?>
				<a href="<?php echo esc_url( get_edit_user_link( $customer_id ) ); ?>" target="_blank">(#<?php echo esc_html( $customer_id ); ?>)</a>
			<?php endif; ?>
		</p>
		<p><strong><?php esc_html_e( 'E-mail :', 'afrikangoods' ); ?></strong>
			<a href="mailto:<?php echo esc_attr( $customer_email ); ?>"><?php echo esc_html( $customer_email ); ?></a>
		</p>
		<p><strong><?php esc_html_e( 'Soumis le :', 'afrikangoods' ); ?></strong>
			<?php echo esc_html( get_the_date( 'j F Y H:i', $post->ID ) ); ?>
		</p>
		<?php
		$replies = get_post_meta( $post->ID, '_requete_replies', true );
		$reply_count = is_array( $replies ) ? count( $replies ) : 0;
		?>
		<p><strong><?php esc_html_e( 'Réponses :', 'afrikangoods' ); ?></strong> <?php echo esc_html( $reply_count ); ?></p>
		<?php
	}

	public function meta_box_conversation( $post ) {
		wp_nonce_field( 'requete_save', 'requete_nonce' );
		$message = get_post_meta( $post->ID, '_requete_message', true );
		$replies = get_post_meta( $post->ID, '_requete_replies', true );
		$status  = $post->post_status;

		if ( ! is_array( $replies ) ) {
			$replies = array();
		}

		echo '<div style="max-height:400px;overflow-y:auto;margin-bottom:1rem;">';

		echo '<div class="requete-message" style="background:#f7fbf7;padding:1rem 1.25rem;margin-bottom:0.75rem;border-radius:8px;border-left:3px solid #8fc98e;">';
		echo '<div style="font-size:0.8125rem;font-weight:600;margin-bottom:0.5rem;">' . esc_html__( 'Message initial', 'afrikangoods' ) . ' <span style="color:#888;font-weight:400;">&mdash; ' . esc_html( get_the_date( 'j F Y H:i', $post->ID ) ) . '</span></div>';
		echo '<div style="line-height:1.6;">' . nl2br( esc_html( $message ) ) . '</div>';
		echo '</div>';

		foreach ( $replies as $reply ) {
			$author_name = isset( $reply['author_name'] ) ? $reply['author_name'] : __( 'Inconnu', 'afrikangoods' );
			$reply_date  = isset( $reply['date'] ) ? $reply['date'] : '';
			$reply_text  = isset( $reply['message'] ) ? $reply['message'] : '';
			$is_admin    = isset( $reply['is_admin'] ) && $reply['is_admin'];
			$style       = $is_admin ? 'border-left-color:#6abf69;background:#f0f7f0;' : 'border-left-color:#8fc98e;background:#f7fbf7;';
			$label       = $is_admin ? __( 'Admin', 'afrikangoods' ) : $author_name;

			echo '<div class="requete-reply" style="' . $style . 'padding:1rem 1.25rem;margin-bottom:0.75rem;border-radius:8px;border-left:3px solid;">';
			echo '<div style="font-size:0.8125rem;font-weight:600;margin-bottom:0.5rem;">' . esc_html( $label ) . ' <span style="color:#888;font-weight:400;">&mdash; ' . esc_html( $reply_date ) . '</span></div>';
			echo '<div style="line-height:1.6;">' . nl2br( esc_html( $reply_text ) ) . '</div>';
			echo '</div>';
		}

		echo '</div>';

		?>
		<div style="border-top:1px solid rgba(0,0,0,0.06);padding-top:1rem;">
			<p><label for="requete_admin_reply" style="font-weight:600;display:block;margin-bottom:0.5rem;"><?php esc_html_e( 'Ajouter une réponse :', 'afrikangoods' ); ?></label></p>
			<textarea id="requete_admin_reply" name="requete_admin_reply" rows="4" style="width:100%;border:1px solid rgba(0,0,0,0.12);border-radius:6px;padding:0.75rem;font-family:inherit;font-size:inherit;resize:vertical;"></textarea>
			<p>
				<label for="requete_status" style="font-weight:600;margin-right:1rem;"><?php esc_html_e( 'Statut :', 'afrikangoods' ); ?></label>
				<select id="requete_status" name="requete_status">
					<option value="nouveau" <?php selected( $status, 'nouveau' ); ?>><?php esc_html_e( 'Nouveau', 'afrikangoods' ); ?></option>
					<option value="en-cours" <?php selected( $status, 'en-cours' ); ?>><?php esc_html_e( 'En cours', 'afrikangoods' ); ?></option>
					<option value="resolu" <?php selected( $status, 'resolu' ); ?>><?php esc_html_e( 'Résolu', 'afrikangoods' ); ?></option>
				</select>
			</p>
			<p><button type="submit" class="button button-primary" name="requete_reply_submit" value="1"><?php esc_html_e( 'Répondre et mettre à jour', 'afrikangoods' ); ?></button></p>
		</div>
		<?php
	}

	public function save_meta( $post_id ) {
		if ( ! isset( $_POST['requete_nonce'] ) || ! wp_verify_nonce( $_POST['requete_nonce'], 'requete_save' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( isset( $_POST['requete_admin_reply'] ) && ! empty( trim( $_POST['requete_admin_reply'] ) ) ) {
			$replies   = get_post_meta( $post_id, '_requete_replies', true );
			if ( ! is_array( $replies ) ) {
				$replies = array();
			}
			$replies[] = array(
				'author_id'   => get_current_user_id(),
				'author_name' => wp_get_current_user()->display_name,
				'message'     => wp_kses_post( trim( $_POST['requete_admin_reply'] ) ),
				'date'        => current_time( 'j F Y H:i' ),
				'timestamp'   => current_time( 'mysql' ),
				'is_admin'    => true,
			);
			update_post_meta( $post_id, '_requete_replies', $replies );
		}

		if ( isset( $_POST['requete_status'] ) && in_array( $_POST['requete_status'], array( 'nouveau', 'en-cours', 'resolu' ) ) ) {
			remove_action( 'save_post_requete', array( $this, 'save_meta' ) );
			wp_update_post( array(
				'ID'          => $post_id,
				'post_status' => $_POST['requete_status'],
			) );
			add_action( 'save_post_requete', array( $this, 'save_meta' ) );
		}
	}

	public function admin_columns( $columns ) {
		$new = array();
		foreach ( $columns as $key => $label ) {
			if ( 'title' === $key ) {
				$new['title'] = __( 'Sujet', 'afrikangoods' );
				$new['customer'] = __( 'Client', 'afrikangoods' );
			} elseif ( 'author' === $key ) {
				continue;
			} elseif ( 'date' === $key ) {
				$new['status'] = __( 'Statut', 'afrikangoods' );
				$new['replies'] = __( 'Réponses', 'afrikangoods' );
				$new['date'] = $label;
			} else {
				$new[ $key ] = $label;
			}
		}
		return $new;
	}

	public function admin_columns_content( $column, $post_id ) {
		switch ( $column ) {
			case 'customer':
				$name  = get_post_meta( $post_id, '_requete_customer_name', true );
				$email = get_post_meta( $post_id, '_requete_customer_email', true );
				echo esc_html( $name ? $name : __( 'Inconnu', 'afrikangoods' ) );
				if ( $email ) {
					echo '<br><a href="mailto:' . esc_attr( $email ) . '" style="font-size:0.8125rem;">' . esc_html( $email ) . '</a>';
				}
				break;
			case 'status':
				$status = get_post_status( $post_id );
				$labels = array(
					'nouveau'  => __( 'Nouveau', 'afrikangoods' ),
					'en-cours' => __( 'En cours', 'afrikangoods' ),
					'resolu'   => __( 'Résolu', 'afrikangoods' ),
				);
				$class  = str_replace( '_', '-', $status );
				echo '<span class="requete-status requete-status-' . esc_attr( $class ) . '">' . esc_html( isset( $labels[ $status ] ) ? $labels[ $status ] : $status ) . '</span>';
				break;
			case 'replies':
				$replies = get_post_meta( $post_id, '_requete_replies', true );
				echo is_array( $replies ) ? count( $replies ) : 0;
				break;
		}
	}

	public function sortable_columns( $columns ) {
		$columns['status'] = 'status';
		return $columns;
	}

	public function admin_status_filter() {
		global $typenow;
		if ( 'requete' !== $typenow ) {
			return;
		}
		$current = isset( $_GET['requete_status'] ) ? $_GET['requete_status'] : '';
		?>
		<select name="requete_status">
			<option value=""><?php esc_html_e( 'Tous les statuts', 'afrikangoods' ); ?></option>
			<option value="nouveau" <?php selected( $current, 'nouveau' ); ?>><?php esc_html_e( 'Nouveau', 'afrikangoods' ); ?></option>
			<option value="en-cours" <?php selected( $current, 'en-cours' ); ?>><?php esc_html_e( 'En cours', 'afrikangoods' ); ?></option>
			<option value="resolu" <?php selected( $current, 'resolu' ); ?>><?php esc_html_e( 'Résolu', 'afrikangoods' ); ?></option>
		</select>
		<?php
	}

	public function admin_status_filter_query( $query ) {
		global $pagenow, $typenow;
		if ( 'edit.php' !== $pagenow || 'requete' !== $typenow || ! $query->is_main_query() ) {
			return;
		}
		if ( ! empty( $_GET['requete_status'] ) ) {
			$query->query_vars['post_status'] = $_GET['requete_status'];
		}
	}

	public function add_myaccount_endpoint() {
		add_rewrite_endpoint( 'requetes', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'requete', EP_ROOT | EP_PAGES );
	}

	public function myaccount_menu_item( $items ) {
		$items['requetes'] = __( 'Mes requêtes', 'afrikangoods' );
		return $items;
	}

	public function myaccount_content() {
		global $wp;

		if ( isset( $wp->query_vars['requete'] ) ) {
			$this->single_requete_view( intval( $wp->query_vars['requete'] ) );
			return;
		}

		$current_user_id = get_current_user_id();
		if ( ! $current_user_id ) {
			echo '<p>' . esc_html__( 'Vous devez être connecté pour voir vos requêtes.', 'afrikangoods' ) . '</p>';
			return;
		}

		$submitted = isset( $_GET['requete-submitted'] ) ? intval( $_GET['requete-submitted'] ) : 0;

		if ( $submitted ) {
			echo '<div class="woocommerce-message" role="alert">' . esc_html__( 'Votre requête a été soumise avec succès. Nous vous répondrons dans les plus brefs délais.', 'afrikangoods' ) . '</div>';
		}

		$requetes = get_posts( array(
			'post_type'      => 'requete',
			'post_status'    => array( 'nouveau', 'en-cours', 'resolu' ),
			'meta_key'       => '_requete_customer_id',
			'meta_value'     => $current_user_id,
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );

		?>
		<h3><?php esc_html_e( 'Mes requêtes', 'afrikangoods' ); ?></h3>

		<p><a href="<?php echo esc_url( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) . '?action=new' ); ?>" class="woocommerce-Button button"><?php esc_html_e( 'Nouvelle requête', 'afrikangoods' ); ?></a></p>

		<?php if ( isset( $_GET['action'] ) && 'new' === $_GET['action'] ) : ?>
			<?php $this->new_requete_form(); ?>
			<?php return; ?>
		<?php endif; ?>

		<?php if ( empty( $requetes ) ) : ?>
			<p><?php esc_html_e( 'Vous n\'avez soumis aucune requête pour le moment.', 'afrikangoods' ); ?></p>
		<?php else : ?>
			<ul class="afrikangoods-requetes-list">
				<?php foreach ( $requetes as $requete ) : ?>
					<?php
					$status = $requete->post_status;
					$labels = array(
						'nouveau'  => __( 'Nouveau', 'afrikangoods' ),
						'en-cours' => __( 'En cours', 'afrikangoods' ),
						'resolu'   => __( 'Résolu', 'afrikangoods' ),
					);
					$replies = get_post_meta( $requete->ID, '_requete_replies', true );
					$reply_count = is_array( $replies ) ? count( $replies ) : 0;
					$url = wc_get_endpoint_url( 'requete', $requete->ID, wc_get_page_permalink( 'myaccount' ) );
					?>
					<li>
						<a href="<?php echo esc_url( $url ); ?>" style="text-decoration:none;color:inherit;">
							<div style="display:flex;justify-content:space-between;align-items:center;">
								<div>
									<strong><?php echo esc_html( $requete->post_title ); ?></strong>
									<div style="font-size:0.8125rem;color:#888;margin-top:0.25rem;">
										<?php echo esc_html( get_the_date( 'j F Y', $requete->ID ) ); ?>
										&middot; <?php echo esc_html( sprintf( _n( '%d réponse', '%d réponses', $reply_count, 'afrikangoods' ), $reply_count ) ); ?>
									</div>
								</div>
								<span class="requete-status requete-status-<?php echo esc_attr( $status ); ?>"><?php echo esc_html( $labels[ $status ] ); ?></span>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<?php
	}

	private function new_requete_form() {
		?>
		<h4><?php esc_html_e( 'Nouvelle requête', 'afrikangoods' ); ?></h4>
		<form method="post" action="">
			<?php wp_nonce_field( 'afrikangoods_new_requete', 'requete_nonce' ); ?>
			<p>
				<label for="requete_title"><?php esc_html_e( 'Sujet *', 'afrikangoods' ); ?></label>
				<input type="text" id="requete_title" name="requete_title" required style="width:100%;max-width:600px;padding:0.5rem;border:1px solid rgba(0,0,0,0.12);border-radius:6px;">
			</p>
			<p>
				<label for="requete_message"><?php esc_html_e( 'Votre message *', 'afrikangoods' ); ?></label>
				<textarea id="requete_message" name="requete_message" rows="6" required style="width:100%;max-width:600px;border:1px solid rgba(0,0,0,0.12);border-radius:6px;padding:0.75rem;font-family:inherit;font-size:inherit;resize:vertical;"></textarea>
			</p>
			<p>
				<button type="submit" class="woocommerce-Button button" name="afrikangoods_submit_requete" value="1"><?php esc_html_e( 'Soumettre la requête', 'afrikangoods' ); ?></button>
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>" style="margin-left:1rem;"><?php esc_html_e( 'Annuler', 'afrikangoods' ); ?></a>
			</p>
		</form>
		<?php
	}

	private function single_requete_view( $requete_id ) {
		$requete = get_post( $requete_id );
		if ( ! $requete || 'requete' !== $requete->post_type ) {
			echo '<p>' . esc_html__( 'Requête introuvable.', 'afrikangoods' ) . '</p>';
			return;
		}

		$current_user_id = get_current_user_id();
		$customer_id     = get_post_meta( $requete->ID, '_requete_customer_id', true );

		if ( intval( $customer_id ) !== $current_user_id && ! current_user_can( 'manage_options' ) ) {
			echo '<p>' . esc_html__( 'Vous n\'êtes pas autorisé à voir cette requête.', 'afrikangoods' ) . '</p>';
			return;
		}

		$message = get_post_meta( $requete->ID, '_requete_message', true );
		$replies = get_post_meta( $requete->ID, '_requete_replies', true );
		if ( ! is_array( $replies ) ) {
			$replies = array();
		}
		$status = $requete->post_status;
		$labels = array(
			'nouveau'  => __( 'Nouveau', 'afrikangoods' ),
			'en-cours' => __( 'En cours', 'afrikangoods' ),
			'resolu'   => __( 'Résolu', 'afrikangoods' ),
		);

		$replied = isset( $_GET['requete-replied'] );

		?>
		<p><a href="<?php echo esc_url( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>">&larr; <?php esc_html_e( 'Retour aux requêtes', 'afrikangoods' ); ?></a></p>

		<?php if ( $replied ) : ?>
			<div class="woocommerce-message" role="alert"><?php esc_html_e( 'Votre réponse a été envoyée.', 'afrikangoods' ); ?></div>
		<?php endif; ?>

		<div style="display:flex;justify-content:space-between;align-items:center;">
			<h3><?php echo esc_html( $requete->post_title ); ?></h3>
			<span class="requete-status requete-status-<?php echo esc_attr( $status ); ?>"><?php echo esc_html( $labels[ $status ] ); ?></span>
		</div>

		<div class="afrikangoods-conversation">
			<div class="message">
				<div class="message-author"><?php esc_html_e( 'Vous', 'afrikangoods' ); ?> <span class="message-date">&mdash; <?php echo esc_html( get_the_date( 'j F Y H:i', $requete->ID ) ); ?></span></div>
				<div class="message-text"><?php echo nl2br( esc_html( $message ) ); ?></div>
			</div>

			<?php foreach ( $replies as $reply ) : ?>
				<?php
				$author_name = isset( $reply['author_name'] ) ? $reply['author_name'] : '';
				$reply_date  = isset( $reply['date'] ) ? $reply['date'] : '';
				$reply_text  = isset( $reply['message'] ) ? $reply['message'] : '';
				$is_admin    = isset( $reply['is_admin'] ) && $reply['is_admin'];
				$class       = $is_admin ? 'message admin' : 'message';
				$label       = $is_admin ? __( 'Support Afrikangoods', 'afrikangoods' ) : $author_name;
				?>
				<div class="<?php echo esc_attr( $class ); ?>">
					<div class="message-author"><?php echo esc_html( $label ); ?> <span class="message-date">&mdash; <?php echo esc_html( $reply_date ); ?></span></div>
					<div class="message-text"><?php echo nl2br( esc_html( $reply_text ) ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( 'resolu' !== $status ) : ?>
			<div class="afrikangoods-requete-reply">
				<h4><?php esc_html_e( 'Ajouter une réponse', 'afrikangoods' ); ?></h4>
				<form method="post" action="">
					<?php wp_nonce_field( 'afrikangoods_requete_reply_' . $requete->ID, 'reply_nonce' ); ?>
					<input type="hidden" name="requete_id" value="<?php echo esc_attr( $requete->ID ); ?>">
					<input type="hidden" name="afrikangoods_client_reply" value="1">
					<textarea name="reply_message" placeholder="<?php esc_attr_e( 'Écrivez votre message...', 'afrikangoods' ); ?>" required></textarea>
					<p><input type="submit" value="<?php esc_attr_e( 'Envoyer', 'afrikangoods' ); ?>"></p>
				</form>
			</div>
		<?php else : ?>
			<p style="color:#888;margin-top:1.5rem;"><?php esc_html_e( 'Cette requête est résolue. Vous ne pouvez plus y répondre.', 'afrikangoods' ); ?></p>
		<?php endif; ?>
		<?php
	}

	public function handle_submission() {
		if ( ! is_account_page() ) {
			return;
		}

		if ( isset( $_POST['afrikangoods_submit_requete'] ) ) {
			if ( ! isset( $_POST['requete_nonce'] ) || ! wp_verify_nonce( $_POST['requete_nonce'], 'afrikangoods_new_requete' ) ) {
				wc_add_notice( __( 'Erreur de sécurité. Veuillez réessayer.', 'afrikangoods' ), 'error' );
				return;
			}

			$user  = wp_get_current_user();
			$title = isset( $_POST['requete_title'] ) ? sanitize_text_field( $_POST['requete_title'] ) : '';
			$message = isset( $_POST['requete_message'] ) ? wp_kses_post( $_POST['requete_message'] ) : '';

			if ( empty( $title ) || empty( $message ) ) {
				wc_add_notice( __( 'Veuillez remplir tous les champs.', 'afrikangoods' ), 'error' );
				return;
			}

			$post_id = wp_insert_post( array(
				'post_title'   => $title,
				'post_content' => '',
				'post_status'  => 'nouveau',
				'post_type'    => 'requete',
				'post_author'  => $user->ID,
			) );

			if ( is_wp_error( $post_id ) ) {
				wc_add_notice( __( 'Erreur lors de la création de la requête.', 'afrikangoods' ), 'error' );
				return;
			}

			update_post_meta( $post_id, '_requete_message', $message );
			update_post_meta( $post_id, '_requete_customer_id', $user->ID );
			update_post_meta( $post_id, '_requete_customer_email', $user->user_email );
			update_post_meta( $post_id, '_requete_customer_name', $user->display_name );

			wp_safe_redirect( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) . '?requete-submitted=' . $post_id );
			exit;
		}

		if ( isset( $_POST['afrikangoods_client_reply'] ) ) {
			$requete_id = isset( $_POST['requete_id'] ) ? intval( $_POST['requete_id'] ) : 0;
			if ( ! $requete_id ) {
				return;
			}

			if ( ! isset( $_POST['reply_nonce'] ) || ! wp_verify_nonce( $_POST['reply_nonce'], 'afrikangoods_requete_reply_' . $requete_id ) ) {
				wc_add_notice( __( 'Erreur de sécurité.', 'afrikangoods' ), 'error' );
				return;
			}

			$requete = get_post( $requete_id );
			if ( ! $requete || 'requete' !== $requete->post_type ) {
				return;
			}

			$customer_id = get_post_meta( $requete->ID, '_requete_customer_id', true );
			if ( intval( $customer_id ) !== get_current_user_id() ) {
				return;
			}

			$reply_message = isset( $_POST['reply_message'] ) ? wp_kses_post( $_POST['reply_message'] ) : '';
			if ( empty( trim( $reply_message ) ) ) {
				wc_add_notice( __( 'Veuillez écrire un message.', 'afrikangoods' ), 'error' );
				return;
			}

			$replies = get_post_meta( $requete->ID, '_requete_replies', true );
			if ( ! is_array( $replies ) ) {
				$replies = array();
			}

			$user = wp_get_current_user();
			$replies[] = array(
				'author_id'   => $user->ID,
				'author_name' => $user->display_name,
				'message'     => $reply_message,
				'date'        => current_time( 'j F Y H:i' ),
				'timestamp'   => current_time( 'mysql' ),
				'is_admin'    => false,
			);
			update_post_meta( $requete->ID, '_requete_replies', $replies );

			if ( 'resolu' !== $requete->post_status ) {
				remove_action( 'save_post_requete', array( $this, 'save_meta' ) );
				wp_update_post( array(
					'ID'          => $requete->ID,
					'post_status' => 'en-cours',
				) );
				add_action( 'save_post_requete', array( $this, 'save_meta' ) );
			}

			wp_safe_redirect( wc_get_endpoint_url( 'requete', $requete->ID, wc_get_page_permalink( 'myaccount' ) ) . '?requete-replied=1' );
			exit;
		}
	}

	public function admin_row_actions( $actions, $post ) {
		if ( 'requete' === $post->post_type && isset( $actions['delete'] ) ) {
			$actions['delete'] = '<a href="' . admin_url( 'admin-post.php?action=afrikangoods_requete_delete&requete_id=' . $post->ID . '&_wpnonce=' . wp_create_nonce( 'afrikangoods_delete_requete_' . $post->ID ) ) . '" style="color:#b32d2e;" onclick="return confirm(\'' . esc_js( __( 'Êtes-vous sûr de vouloir supprimer définitivement cette requête ?', 'afrikangoods' ) ) . '\');">' . __( 'Supprimer définitivement', 'afrikangoods' ) . '</a>';
		}
		return $actions;
	}

	public function admin_handle_reply() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Accès refusé.', 'afrikangoods' ) );
		}
	}

	public function admin_handle_delete() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Accès refusé.', 'afrikangoods' ) );
		}
		$requete_id = isset( $_GET['requete_id'] ) ? intval( $_GET['requete_id'] ) : 0;
		if ( ! $requete_id || ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'afrikangoods_delete_requete_' . $requete_id ) ) {
			wp_die( __( 'Lien invalide.', 'afrikangoods' ) );
		}
		wp_delete_post( $requete_id, true );
		wp_safe_redirect( admin_url( 'edit.php?post_type=requete' ) );
		exit;
	}

	public function ajax_reply() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => __( 'Accès refusé.', 'afrikangoods' ) ) );
		}
		wp_send_json_error( array( 'message' => 'AJAX not implemented' ) );
	}

	public function ajax_delete() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => __( 'Accès refusé.', 'afrikangoods' ) ) );
		}

		$requete_id = isset( $_POST['requete_id'] ) ? intval( $_POST['requete_id'] ) : 0;
		if ( ! $requete_id ) {
			wp_send_json_error( array( 'message' => __( 'ID invalide.', 'afrikangoods' ) ) );
		}

		wp_delete_post( $requete_id, true );
		wp_send_json_success( array( 'message' => __( 'Requête supprimée.', 'afrikangoods' ) ) );
	}
}
