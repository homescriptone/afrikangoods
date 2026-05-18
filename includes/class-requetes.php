<?php

class Afrikangoods_Requetes {

	public function init() {
		$this->register_post_type();
		$this->add_myaccount_endpoint();

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post_requete', array( $this, 'save_requete' ) );
		add_filter( 'manage_requete_posts_columns', array( $this, 'admin_columns' ) );
		add_action( 'manage_requete_posts_custom_column', array( $this, 'admin_columns_content' ), 10, 2 );
		add_filter( 'manage_edit-requete_sortable_columns', array( $this, 'sortable_columns' ) );
		add_filter( 'woocommerce_account_menu_items', array( $this, 'myaccount_menu_item' ), 40 );
		add_action( 'woocommerce_account_requetes_endpoint', array( $this, 'myaccount_content' ) );
		add_action( 'template_redirect', array( $this, 'handle_forms' ) );
		add_filter( 'post_row_actions', array( $this, 'row_actions' ), 10, 2 );
		add_action( 'admin_post_afrikangoods_delete_requete', array( $this, 'handle_delete' ) );
	}

	private function register_post_type() {
		register_post_type( 'requete', array(
			'labels'       => array(
				'name'               => __( 'Requêtes', 'afrikangoods' ),
				'singular_name'      => __( 'Requête', 'afrikangoods' ),
				'menu_name'          => __( 'Requêtes', 'afrikangoods' ),
				'add_new'            => __( 'Nouvelle requête', 'afrikangoods' ),
				'add_new_item'       => __( 'Ajouter une requête', 'afrikangoods' ),
				'edit_item'          => __( 'Modifier la requête', 'afrikangoods' ),
				'view_item'          => __( 'Voir la requête', 'afrikangoods' ),
				'search_items'       => __( 'Rechercher', 'afrikangoods' ),
				'not_found'          => __( 'Aucune requête', 'afrikangoods' ),
				'not_found_in_trash' => __( 'Aucune requête dans la corbeille', 'afrikangoods' ),
				'all_items'          => __( 'Toutes les requêtes', 'afrikangoods' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-email-alt',
			'menu_position' => 56,
			'capabilities' => array(
				'edit_post'          => 'manage_options',
				'read_post'          => 'manage_options',
				'delete_post'        => 'manage_options',
				'edit_posts'         => 'manage_options',
				'edit_others_posts'  => 'manage_options',
				'publish_posts'      => 'manage_options',
				'read_private_posts' => 'manage_options',
				'delete_posts'       => 'manage_options',
			),
			'map_meta_cap' => true,
			'supports'     => array( 'title', 'author' ),
			'has_archive'  => false,
			'rewrite'      => false,
			'query_var'    => false,
		) );
	}

	private function add_myaccount_endpoint() {
		add_rewrite_endpoint( 'requetes', EP_ROOT | EP_PAGES );
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
	}

	public function meta_box_conversation( $post ) {
		wp_nonce_field( 'requete_reply', 'requete_nonce' );
		$conversation = get_post_meta( $post->ID, '_conversation', true );
		$status       = get_post_meta( $post->ID, '_status', true ) ?: 'nouveau';

		if ( ! is_array( $conversation ) ) {
			$conversation = array();
		}

		$labels = array(
			'nouveau'  => __( 'Nouveau', 'afrikangoods' ),
			'en-cours' => __( 'En cours', 'afrikangoods' ),
			'resolu'   => __( 'Résolu', 'afrikangoods' ),
		);

		echo '<p><strong>' . esc_html__( 'Statut :', 'afrikangoods' ) . '</strong> ';
		echo '<select name="requete_status">';
		foreach ( $labels as $val => $label ) {
			echo '<option value="' . esc_attr( $val ) . '" ' . selected( $status, $val, false ) . '>' . esc_html( $label ) . '</option>';
		}
		echo '</select></p>';

		echo '<div style="max-height:450px;overflow-y:auto;margin-bottom:1rem;">';

		if ( empty( $conversation ) ) {
			echo '<p style="color:#888;">' . esc_html__( 'Aucun message dans cette requête.', 'afrikangoods' ) . '</p>';
		} else {
			foreach ( $conversation as $msg ) {
				$author = isset( $msg['author'] ) ? $msg['author'] : '';
				$date   = isset( $msg['date'] ) ? $msg['date'] : '';
				$content = isset( $msg['content'] ) ? $msg['content'] : '';
				$type   = isset( $msg['type'] ) ? $msg['type'] : 'customer';
				$style  = 'admin' === $type
					? 'border-left:3px solid #6abf69;background:#f0f7f0;'
					: 'border-left:3px solid #8fc98e;background:#f7fbf7;';
				$label  = 'admin' === $type ? __( 'Support', 'afrikangoods' ) : $author;

				echo '<div style="' . $style . 'padding:1rem 1.25rem;margin-bottom:0.75rem;border-radius:8px;">';
				echo '<div style="font-size:0.8125rem;font-weight:600;margin-bottom:0.5rem;">'
					. esc_html( $label )
					. ' <span style="color:#888;font-weight:400;">&mdash; ' . esc_html( $date ) . '</span></div>';
				echo '<div style="line-height:1.6;">' . nl2br( esc_html( $content ) ) . '</div>';
				echo '</div>';
			}
		}

		echo '</div>';

		echo '<div style="border-top:1px solid rgba(0,0,0,0.06);padding-top:1rem;">';
		echo '<label for="requete_reply" style="font-weight:600;display:block;margin-bottom:0.5rem;">'
			. esc_html__( 'Répondre :', 'afrikangoods' ) . '</label>';
		echo '<textarea id="requete_reply" name="requete_reply" rows="4" style="width:100%;border:1px solid rgba(0,0,0,0.12);border-radius:6px;padding:0.75rem;font-family:inherit;font-size:inherit;resize:vertical;"></textarea>';
		echo '<p style="margin-top:0.5rem;"><button type="submit" class="button button-primary" name="requete_reply_submit" value="1">'
			. esc_html__( 'Envoyer la réponse', 'afrikangoods' ) . '</button></p>';
		echo '</div>';
	}

	public function save_requete( $post_id ) {
		if ( ! isset( $_POST['requete_nonce'] ) || ! wp_verify_nonce( $_POST['requete_nonce'], 'requete_reply' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( isset( $_POST['requete_status'] ) ) {
			update_post_meta( $post_id, '_status', sanitize_text_field( $_POST['requete_status'] ) );
		}

		if ( ! empty( $_POST['requete_reply'] ) && isset( $_POST['requete_reply_submit'] ) ) {
			$conversation = get_post_meta( $post_id, '_conversation', true );
			if ( ! is_array( $conversation ) ) {
				$conversation = array();
			}

			$conversation[] = array(
				'author'    => wp_get_current_user()->display_name,
				'type'      => 'admin',
				'content'   => wp_kses_post( trim( $_POST['requete_reply'] ) ),
				'date'      => current_time( 'j F Y H:i' ),
				'timestamp' => current_time( 'mysql' ),
			);

			update_post_meta( $post_id, '_conversation', $conversation );
		}
	}

	public function admin_columns( $columns ) {
		$new = array();
		foreach ( $columns as $key => $label ) {
			if ( 'title' === $key ) {
				$new['title']  = __( 'Sujet', 'afrikangoods' );
				$new['customer'] = __( 'Client', 'afrikangoods' );
			} elseif ( 'author' === $key ) {
				continue;
			} elseif ( 'date' === $key ) {
				$new['status'] = __( 'Statut', 'afrikangoods' );
				$new['msgs']   = __( 'Messages', 'afrikangoods' );
				$new['date']   = $label;
			} else {
				$new[ $key ] = $label;
			}
		}
		return $new;
	}

	public function admin_columns_content( $column, $post_id ) {
		switch ( $column ) {
			case 'customer':
				$name  = get_post_meta( $post_id, '_customer_name', true );
				$email = get_post_meta( $post_id, '_customer_email', true );
				echo esc_html( $name ?: __( 'Inconnu', 'afrikangoods' ) );
				if ( $email ) {
					echo '<br><a href="mailto:' . esc_attr( $email ) . '" style="font-size:0.8125rem;">' . esc_html( $email ) . '</a>';
				}
				break;
			case 'status':
				$status = get_post_meta( $post_id, '_status', true ) ?: 'nouveau';
				$labels = array(
					'nouveau'  => __( 'Nouveau', 'afrikangoods' ),
					'en-cours' => __( 'En cours', 'afrikangoods' ),
					'resolu'   => __( 'Résolu', 'afrikangoods' ),
				);
				echo '<span class="requete-status requete-status-' . esc_attr( $status ) . '">'
					. esc_html( $labels[ $status ] ?? $status ) . '</span>';
				break;
			case 'msgs':
				$conv = get_post_meta( $post_id, '_conversation', true );
				echo is_array( $conv ) ? count( $conv ) : 0;
				break;
		}
	}

	public function sortable_columns( $columns ) {
		$columns['status'] = 'status';
		return $columns;
	}

	public function myaccount_menu_item( $items ) {
		$items['requetes'] = __( 'Mes requêtes', 'afrikangoods' );
		return $items;
	}

	public function myaccount_content() {
		global $wp;

		$current_user_id = get_current_user_id();
		if ( ! $current_user_id ) {
			echo '<p>' . esc_html__( 'Connectez-vous pour voir vos requêtes.', 'afrikangoods' ) . '</p>';
			return;
		}

		if ( isset( $wp->query_vars['requete'] ) && is_numeric( $wp->query_vars['requete'] ) ) {
			$this->single_view( intval( $wp->query_vars['requete'] ) );
			return;
		}

		$customer_id = get_user_meta( $current_user_id, 'afrikangoods_customer_id', true ) ?: $current_user_id;

		if ( isset( $_GET['new'] ) ) {
			$this->new_form();
			return;
		}

		$submitted = isset( $_GET['submitted'] ) ? intval( $_GET['submitted'] ) : 0;
		if ( $submitted ) {
			echo '<div class="woocommerce-message">' . esc_html__( 'Votre requête a été envoyée.', 'afrikangoods' ) . '</div>';
		}

		$replied = isset( $_GET['replied'] );
		if ( $replied ) {
			echo '<div class="woocommerce-message">' . esc_html__( 'Votre réponse a été envoyée.', 'afrikangoods' ) . '</div>';
		}

		echo '<h3>' . esc_html__( 'Mes requêtes', 'afrikangoods' ) . '</h3>';
		echo '<p><a href="' . esc_url( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) . '?new=1' ) . '" class="woocommerce-Button button">'
			. esc_html__( 'Nouvelle requête', 'afrikangoods' ) . '</a></p>';

		$requetes = get_posts( array(
			'post_type'      => 'requete',
			'post_status'    => 'any',
			'meta_key'       => '_customer_id',
			'meta_value'     => $customer_id,
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );

		if ( empty( $requetes ) ) {
			echo '<p>' . esc_html__( 'Aucune requête pour le moment.', 'afrikangoods' ) . '</p>';
			return;
		}

		$status_labels = array(
			'nouveau'  => __( 'Nouveau', 'afrikangoods' ),
			'en-cours' => __( 'En cours', 'afrikangoods' ),
			'resolu'   => __( 'Résolu', 'afrikangoods' ),
		);

		echo '<ul class="afrikangoods-requetes-list">';
		foreach ( $requetes as $r ) {
			$status = get_post_meta( $r->ID, '_status', true ) ?: 'nouveau';
			$conv   = get_post_meta( $r->ID, '_conversation', true );
			$count  = is_array( $conv ) ? count( $conv ) : 0;
			$url    = wc_get_endpoint_url( 'requete', $r->ID, wc_get_page_permalink( 'myaccount' ) );
			echo '<li>';
			echo '<a href="' . esc_url( $url ) . '" style="text-decoration:none;color:inherit;">';
			echo '<div style="display:flex;justify-content:space-between;align-items:center;">';
			echo '<div><strong>' . esc_html( $r->post_title ) . '</strong>';
			echo '<div style="font-size:0.8125rem;color:#888;margin-top:0.25rem;">'
				. esc_html( get_the_date( 'j F Y', $r->ID ) )
				. ' &middot; ' . esc_html( sprintf( _n( '%d message', '%d messages', $count, 'afrikangoods' ), $count ) )
				. '</div></div>';
			echo '<span class="requete-status requete-status-' . esc_attr( $status ) . '">'
				. esc_html( $status_labels[ $status ] ?? $status ) . '</span>';
			echo '</div>';
			echo '</a>';
			echo '</li>';
		}
		echo '</ul>';
	}

	private function new_form() {
		?>
		<h4><?php esc_html_e( 'Nouvelle requête', 'afrikangoods' ); ?></h4>
		<form method="post" action="">
			<?php wp_nonce_field( 'new_requete', 'requete_nonce' ); ?>
			<p>
				<label for="r_title"><?php esc_html_e( 'Sujet *', 'afrikangoods' ); ?></label><br>
				<input type="text" id="r_title" name="r_title" required style="width:100%;max-width:600px;padding:0.5rem;border:1px solid rgba(0,0,0,0.12);border-radius:6px;">
			</p>
			<p>
				<label for="r_message"><?php esc_html_e( 'Message *', 'afrikangoods' ); ?></label><br>
				<textarea id="r_message" name="r_message" rows="6" required style="width:100%;max-width:600px;border:1px solid rgba(0,0,0,0.12);border-radius:6px;padding:0.75rem;font-family:inherit;font-size:inherit;resize:vertical;"></textarea>
			</p>
			<p>
				<button type="submit" class="woocommerce-Button button" name="submit_new_requete" value="1"><?php esc_html_e( 'Envoyer', 'afrikangoods' ); ?></button>
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>" style="margin-left:1rem;"><?php esc_html_e( 'Annuler', 'afrikangoods' ); ?></a>
			</p>
		</form>
		<?php
	}

	private function single_view( $requete_id ) {
		$requete = get_post( $requete_id );
		if ( ! $requete || 'requete' !== $requete->post_type ) {
			echo '<p>' . esc_html__( 'Requête introuvable.', 'afrikangoods' ) . '</p>';
			return;
		}

		$customer_id = get_post_meta( $requete->ID, '_customer_id', true );
		$user_id     = get_current_user_id();
		$user_cid    = get_user_meta( $user_id, 'afrikangoods_customer_id', true ) ?: $user_id;

		if ( $customer_id != $user_cid && ! current_user_can( 'manage_options' ) ) {
			echo '<p>' . esc_html__( 'Accès refusé.', 'afrikangoods' ) . '</p>';
			return;
		}

		$conversation = get_post_meta( $requete->ID, '_conversation', true );
		if ( ! is_array( $conversation ) ) {
			$conversation = array();
		}

		$status = get_post_meta( $requete->ID, '_status', true ) ?: 'nouveau';
		$status_labels = array(
			'nouveau'  => __( 'Nouveau', 'afrikangoods' ),
			'en-cours' => __( 'En cours', 'afrikangoods' ),
			'resolu'   => __( 'Résolu', 'afrikangoods' ),
		);

		$replied = isset( $_GET['replied'] );
		?>
		<p><a href="<?php echo esc_url( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>">&larr; <?php esc_html_e( 'Retour', 'afrikangoods' ); ?></a></p>

		<?php if ( $replied ) : ?>
			<div class="woocommerce-message"><?php esc_html_e( 'Message envoyé.', 'afrikangoods' ); ?></div>
		<?php endif; ?>

		<div style="display:flex;justify-content:space-between;align-items:center;">
			<h3><?php echo esc_html( $requete->post_title ); ?></h3>
			<span class="requete-status requete-status-<?php echo esc_attr( $status ); ?>"><?php echo esc_html( $status_labels[ $status ] ); ?></span>
		</div>

		<div class="afrikangoods-conversation">
			<?php foreach ( $conversation as $msg ) : ?>
				<?php
				$author  = isset( $msg['author'] ) ? $msg['author'] : '';
				$date    = isset( $msg['date'] ) ? $msg['date'] : '';
				$content = isset( $msg['content'] ) ? $msg['content'] : '';
				$type    = isset( $msg['type'] ) ? $msg['type'] : 'customer';
				$class   = 'admin' === $type ? 'message admin' : 'message';
				$label   = 'admin' === $type ? __( 'Support Afrikangoods', 'afrikangoods' ) : $author;
				?>
				<div class="<?php echo esc_attr( $class ); ?>">
					<div class="message-author"><?php echo esc_html( $label ); ?> <span class="message-date">&mdash; <?php echo esc_html( $date ); ?></span></div>
					<div class="message-text"><?php echo nl2br( esc_html( $content ) ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( 'resolu' !== $status ) : ?>
			<div class="afrikangoods-requete-reply">
				<h4><?php esc_html_e( 'Répondre', 'afrikangoods' ); ?></h4>
				<form method="post" action="">
					<?php wp_nonce_field( 'reply_requete_' . $requete->ID, 'reply_nonce' ); ?>
					<input type="hidden" name="requete_id" value="<?php echo esc_attr( $requete->ID ); ?>">
					<textarea name="reply_message" placeholder="<?php esc_attr_e( 'Écrivez votre message...', 'afrikangoods' ); ?>" required></textarea>
					<p><input type="submit" value="<?php esc_attr_e( 'Envoyer', 'afrikangoods' ); ?>"></p>
				</form>
			</div>
		<?php else : ?>
			<p style="color:#888;margin-top:1.5rem;"><?php esc_html_e( 'Requête résolue.', 'afrikangoods' ); ?></p>
		<?php endif; ?>
		<?php
	}

	public function handle_forms() {
		if ( ! is_account_page() ) {
			return;
		}

		if ( isset( $_POST['submit_new_requete'] ) ) {
			if ( ! isset( $_POST['requete_nonce'] ) || ! wp_verify_nonce( $_POST['requete_nonce'], 'new_requete' ) ) {
				wc_add_notice( __( 'Erreur de sécurité.', 'afrikangoods' ), 'error' );
				return;
			}

			$user    = wp_get_current_user();
			$title   = isset( $_POST['r_title'] ) ? sanitize_text_field( $_POST['r_title'] ) : '';
			$message = isset( $_POST['r_message'] ) ? wp_kses_post( $_POST['r_message'] ) : '';

			if ( empty( $title ) || empty( $message ) ) {
				wc_add_notice( __( 'Champs obligatoires.', 'afrikangoods' ), 'error' );
				return;
			}

			$customer_id = get_user_meta( $user->ID, 'afrikangoods_customer_id', true ) ?: $user->ID;

			$post_id = wp_insert_post( array(
				'post_title'  => $title,
				'post_status' => 'publish',
				'post_type'   => 'requete',
				'post_author' => $user->ID,
			) );

			if ( is_wp_error( $post_id ) ) {
				return;
			}

			update_post_meta( $post_id, '_customer_id', $customer_id );
			update_post_meta( $post_id, '_customer_name', $user->display_name );
			update_post_meta( $post_id, '_customer_email', $user->user_email );
			update_post_meta( $post_id, '_status', 'nouveau' );
			update_post_meta( $post_id, '_conversation', array(
				array(
					'author'    => $user->display_name,
					'type'      => 'customer',
					'content'   => $message,
					'date'      => current_time( 'j F Y H:i' ),
					'timestamp' => current_time( 'mysql' ),
				),
			) );

			wp_safe_redirect( wc_get_endpoint_url( 'requetes', '', wc_get_page_permalink( 'myaccount' ) ) . '?submitted=' . $post_id );
			exit;
		}

		if ( isset( $_POST['reply_message'] ) ) {
			$requete_id = isset( $_POST['requete_id'] ) ? intval( $_POST['requete_id'] ) : 0;
			if ( ! $requete_id ) {
				return;
			}
			if ( ! isset( $_POST['reply_nonce'] ) || ! wp_verify_nonce( $_POST['reply_nonce'], 'reply_requete_' . $requete_id ) ) {
				wc_add_notice( __( 'Erreur de sécurité.', 'afrikangoods' ), 'error' );
				return;
			}

			$requete = get_post( $requete_id );
			if ( ! $requete || 'requete' !== $requete->post_type ) {
				return;
			}

			$customer_id = get_post_meta( $requete->ID, '_customer_id', true );
			$user_id     = get_current_user_id();
			$user_cid    = get_user_meta( $user_id, 'afrikangoods_customer_id', true ) ?: $user_id;
			if ( $customer_id != $user_cid ) {
				return;
			}

			$status = get_post_meta( $requete->ID, '_status', true ) ?: 'nouveau';
			if ( 'resolu' === $status ) {
				return;
			}

			$content = isset( $_POST['reply_message'] ) ? wp_kses_post( $_POST['reply_message'] ) : '';
			if ( empty( trim( $content ) ) ) {
				return;
			}

			$conversation = get_post_meta( $requete->ID, '_conversation', true );
			if ( ! is_array( $conversation ) ) {
				$conversation = array();
			}

			$user = wp_get_current_user();
			$conversation[] = array(
				'author'    => $user->display_name,
				'type'      => 'customer',
				'content'   => $content,
				'date'      => current_time( 'j F Y H:i' ),
				'timestamp' => current_time( 'mysql' ),
			);
			update_post_meta( $requete->ID, '_conversation', $conversation );

			if ( 'nouveau' === $status ) {
				update_post_meta( $requete->ID, '_status', 'en-cours' );
			}

			wp_safe_redirect( wc_get_endpoint_url( 'requete', $requete->ID, wc_get_page_permalink( 'myaccount' ) ) . '?replied=1' );
			exit;
		}
	}

	public function row_actions( $actions, $post ) {
		if ( 'requete' === $post->post_type && isset( $actions['delete'] ) ) {
			$actions['delete'] = '<a href="' . admin_url( 'admin-post.php?action=afrikangoods_delete_requete&requete_id=' . $post->ID . '&_wpnonce=' . wp_create_nonce( 'delete_requete_' . $post->ID ) ) . '" style="color:#b32d2e;" onclick="return confirm(\'' . esc_js( __( 'Supprimer définitivement ?', 'afrikangoods' ) ) . '\');">' . __( 'Supprimer définitivement', 'afrikangoods' ) . '</a>';
		}
		return $actions;
	}

	public function handle_delete() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Accès refusé.', 'afrikangoods' ) );
		}
		$id = isset( $_GET['requete_id'] ) ? intval( $_GET['requete_id'] ) : 0;
		if ( ! $id || ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'delete_requete_' . $id ) ) {
			wp_die( __( 'Lien invalide.', 'afrikangoods' ) );
		}
		wp_delete_post( $id, true );
		wp_safe_redirect( admin_url( 'edit.php?post_type=requete' ) );
		exit;
	}
}
