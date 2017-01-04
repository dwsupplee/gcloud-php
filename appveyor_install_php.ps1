try {
	curl -fsS -o php-$env:PHP_VERSION.zip http://windows.php.net/downloads/releases/php-$env:PHP_VERSION.zip
    appveyor DownloadFile
} catch {
	curl -fsS -o php-$env:PHP_VERSION.zip http://windows.php.net/downloads/releases/archives/php-$env:PHP_VERSION.zip
}
7z x php-$env:PHP_VERSION.zip -oc:\tools\php
