appveyor DownloadFile http://windows.php.net/downloads/releases/archives/php-$env:PHP_VERSION-nts-Win32-VC11-x86.zip
7z x php-$env:PHP_VERSION-nts-Win32-VC11-x86.zip -oc:\tools\php
