<?php

class Afrikangoods_GitHub_Updater {
	private string $slug;
	private string $repo;
	private string $current_version;

	public function __construct() {
		$this->slug            = 'afrikangoods';
		$this->repo            = 'homescriptone/afrikangoods';
		$this->current_version = AFRIKANGOODS_THEME_VERSION;
	}

	public function init(): void {
		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_update' ), 10, 1 );
		add_filter( 'themes_api', array( $this, 'theme_info' ), 10, 3 );
	}

	public function check_update( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		$release = $this->fetch_latest_release();
		if ( ! $release ) {
			return $transient;
		}

		$latest = ltrim( $release['tag_name'], 'v' );
		if ( version_compare( $this->current_version, $latest, '>=' ) ) {
			return $transient;
		}

		$download_url = '';
		if ( ! empty( $release['assets'] ) ) {
			foreach ( $release['assets'] as $asset ) {
				if ( str_ends_with( $asset['name'], '.zip' ) ) {
					$download_url = $asset['browser_download_url'];
					break;
				}
			}
		}
		if ( ! $download_url && ! empty( $release['zipball_url'] ) ) {
			$download_url = $release['zipball_url'];
		}

		$transient->response[ $this->slug ] = array(
			'new_version' => $latest,
			'package'     => $download_url,
			'url'         => "https://github.com/{$this->repo}",
		);

		return $transient;
	}

	public function theme_info( $result, $action, $args ) {
		if ( 'theme_information' !== $action || ! isset( $args->slug ) || $args->slug !== $this->slug ) {
			return $result;
		}

		$release = $this->fetch_latest_release();
		if ( ! $release ) {
			return $result;
		}

		return (object) array(
			'slug'          => $this->slug,
			'name'          => 'Afrikangoods',
			'version'       => ltrim( $release['tag_name'], 'v' ),
			'author'        => '<a href="https://github.com/homescriptone">UltiWP</a>',
			'requires'      => '7.0',
			'tested'        => '7.0-RC4',
			'requires_php'  => '5.7',
			'download_link' => ! empty( $release['assets'][0]['browser_download_url'] )
				? $release['assets'][0]['browser_download_url']
				: $release['zipball_url'],
			'last_updated'  => $release['published_at'],
			'sections'      => array(
				'description' => 'A child theme for kiosko selling African raw products with WooCommerce.',
				'changelog'   => $release['body'] ?? 'See GitHub releases for details.',
			),
		);
	}

	private function fetch_latest_release(): ?array {
		$cache_key = 'afrikangoods_github_release';
		$cached    = get_transient( $cache_key );
		if ( false !== $cached ) {
			return $cached;
		}

		$response = wp_remote_get(
			"https://api.github.com/repos/{$this->repo}/releases/latest",
			array(
				'headers' => array( 'Accept' => 'application/vnd.github.v3+json' ),
				'timeout' => 10,
			)
		);

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			set_transient( $cache_key, null, HOUR_IN_SECONDS );
			return null;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( ! is_array( $data ) || empty( $data['tag_name'] ) ) {
			return null;
		}

		set_transient( $cache_key, $data, HOUR_IN_SECONDS );
		return $data;
	}
}
