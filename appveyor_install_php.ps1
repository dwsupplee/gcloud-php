$file = "php-$env:PHP_VERSION.zip"
$url = "http://windows.php.net/downloads/releases/$file"
$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$client = New-Object NET.WebClient
$path = "C:\tools\php\$file"

try {
    appveyor DownloadFile $url
} catch {
	appveyor DownloadFile $archiveUrl
}

7z x $file -oc:\tools\php
