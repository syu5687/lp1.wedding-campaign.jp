<?php
/**
 * WordPress の基本設定
 */

// Cloud SQL 用（環境変数で設定）
define( 'DB_NAME', getenv('DB_NAME') );
define( 'DB_USER', getenv('DB_USER') );
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );
define( 'DB_HOST', getenv('DB_HOST') ); // unix_socket or IP address

define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// Cloud Storage 連携の場合は wp-content/uploads を GCS マウントしたパスに変更
// define( 'UPLOADS', 'gs://your-gcs-bucket/wp-content/uploads' ); // プラグインで対応する場合は不要

// 認証用キー
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));

// DB テーブルプレフィックス
$table_prefix = 'wp_';

// デバッグモード
define('WP_DEBUG', false);

// Cloud Run 用のリバースプロキシ対策
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

// HTTPS リダイレクト強制（オプション）
/*
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] !== 'https') {
	header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
	exit;
}
*/

// WordPress インストールディレクトリの絶対パス
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';