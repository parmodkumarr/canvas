<?php

	


	if ($_SERVER['REMOTE_ADDR']=='127.0.0.1')
	{
		// состояние сайта
		define('SITE_STATE', 'local');

		// кеширование (отключено)
		define('SITE_CASH', false);

		// настройки для БД
		define('DB_HOST', '127.0.0.1');
		define('DB_USER', 'root');
		define('DB_PASS', '');
		define('DB_NAME', 'financies');
		define('DB_PORT', null);
		define('DB_SOCKET', null);
		define('DB_TABLE_PREFIX', 'fin_');
	}
	else
	{
		// состояние сайта
		define('SITE_STATE', 'online');

		// кеширование (включено)
		define('SITE_CASH', false);
		// настройки для БД
		define('DB_HOST', 'localhost');
		define('DB_USER', 'finance_1');
		define('DB_PASS', 'finance_1');
		define('DB_NAME', 'finance_1');
		define('DB_PORT', null);
		define('DB_SOCKET', null);
		define('DB_TABLE_PREFIX', 'fin_');
	}


	
?>
