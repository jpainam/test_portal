<?php
/**
	Environnement de developpement
	Remettre cela a false lors du deploiement
	Si definie a false, aucune erreur ne sera lever ou afficher,
	les erreurs seront enregistrer dans le fichier temp/log.txt
*/
define('DEVELOPMENT_ENVIRONMENT', false);
define("REMOTE_SERVER", "https://www.uacosendai-edu.net/eschool/");

/**
	definir l'adresse du site
	Definir par exemple
	define('SITE_ROOT', 'http://192.168.1.103') si le serveur est distant
*/
define('SITE_ROOT', 'http://localhost/ipw/');
//define('SITE_ROOT', 'http://10.10.10.1/locan/');
define('DEFAULT_CONTROLLER', "index");
define('DEFAULT_ACTION', "index");

define("DB_NAME", 'ipw');
define("DB_USER", 'root');
define("DB_PASSWORD", "");
define("DB_HOST", 'localhost');


/**
 * NOTIFICATION PARAMETERS
 */
define("CODE_PAYS", "+237");
define("SEND_NOTE_NOTIFICATION_DIRECTLY", false);
define("PHONE_NUMBER_DIGIT_LENGTH", 8);
define("INSTITUTION_CODE", "IPBW");
define("SEND_NOTIFICATION_DIRECTLY", "SEND_NOTIFICATION_DIRECTLY");
define("SEND_NOTIFICATION_APPEL_DIRECTLY", "SEND_NOTIFICATION_APPEL_DIRECTLY");
define("SEND_NOTIFICATION_CAISSE_DIRECTLY", "SEND_NOTIFICATION_CAISSE_DIRECTLY");
define("ENVOIINDIVIDUEL", 1);
define("ENVOIPARCLASSE", 2);
define("ENVOICOLLECTIF", 3);
define("MUST_PAY_ALL_REQUIRED_FEES", false);