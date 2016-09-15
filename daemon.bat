:: Configure this (use absolute path)
:: php cli path
set PHP=C:\xampp\php\php.exe
:: daemon.php path
set DAEMON=C:\xampp\htdocs\smsgateway\smsautoreply.php

:: Execute
%PHP% %DAEMON%
