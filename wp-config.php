<?php
/**
 * WordPress の基本設定
 */

// Cloud SQL 用（環境変数で設定）
define( 'DB_NAME', getenv('DB_NAME') );
define( 'DB_USER', getenv('DB_USER') );
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );
define( 'DB_HOST', getenv('DB_HOST') ); // unix_socket か IP address を指定

define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// Cloud Stdorage 連携する場合：uploads を外部にマウントしていればこの行は不要
// define( 'UPLOADS', 'gs://your-gcs-bucket/wp-content/uploads' );

// 認証用キー（環境変数から取得）
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));

// DB テーブルのプレフィックス
$table_prefix = 'wp_';

// デバッグモード（本番環境では false 推奨）
define('WP_DEBUG', false);

// Cloud Run リバースプロキシ対策（https でないとCSSが崩れる問題回避）
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

// WordPress URL を明示的に https:// に固定（Cloud Run の本番 URL を記載）
define('WP_HOME', 'https://lp1-wedding-campaign-jp-665477084949.asia-northeast1.run.app');
define('WP_SITEURL', 'https://lp1-wedding-campaign-jp-665477084949.asia-northeast1.run.app');

/*
// オプション：強制的に https にリdダイレクトする場合はこちらも有効に
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] !== 'https') {
	header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
	exit;
}
*/

// WordPress インストールディレクトリの絶対パスを定義
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

// 設定ファイルを読み込み
require_once ABSPATH . 'wp-settings.php';