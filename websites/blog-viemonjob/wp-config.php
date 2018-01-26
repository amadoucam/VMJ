<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wp_vmj');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'RocquetDeMalherbe');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q<c2b>:3SCu(!pj$0h6f)Ct@1nOS4/?Hzq!n5d:~47Wq/92D,/9SHn#l<gzcC~Tn');
define('SECURE_AUTH_KEY',  '1);K;DjIvZ6Kc%h$2rH@kc^bM}}j4i_rO;uL.)Q]UzdVK|~;[I[Pyq6G6:A-HJ}e');
define('LOGGED_IN_KEY',    'oE(,Etf/eEAD*V ?i!KfWR}q4j?vfw!OAZ}UF08;+*bS{LXJx(%|(+gn5*#rKy~k');
define('NONCE_KEY',        'svAg+uWL$[3*Z]xjS,peJDo6*GvO6Hpfy%x);qosiz&Uu14/p=kh0 ]?YIu##R:)');
define('AUTH_SALT',        'A/aTq&bY2V~*M79Ze5fA6{l[td!qfO)+1kB*jwp_@^uG/`n4T8*wq16rkLE~29x_');
define('SECURE_AUTH_SALT', ':v{nMX]j>SLPA;[l?Dr4<XA_)8BL<k~nT17;uT_=Np/ofF.zJ5c5*#`YD)sb+0S2');
define('LOGGED_IN_SALT',   '~8zG~)4NfnuS[Dg9VXCnGQ~alP=02ilPff]ky:m0fD/x!i*2U2-cu8=Uk6>~AMMj');
define('NONCE_SALT',       'JP,6(*0D.-Vo=s1FNLJ%x6%]i:6Vw0.Mz;.cy2;c(@Hb>9Viyg^Iw7%)o6cVx6M~');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_vmj';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
define('FTP_PUBKEY','/root/.ssh/authorized_key');
define('FTP_PRIKEY','/root/.ssh/id_rsa');
define('FTP_USER','user');
define('FTP_PASS','');
define('FTP_HOST','blog.viemonjob.com');
/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
