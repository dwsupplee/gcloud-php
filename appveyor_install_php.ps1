$file = "php-$env:PHP_VERSION.zip"
$url = "http://windows.php.net/downloads/releases/$file"
$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$client = New-Object NET.WebClient
$path = "C:\tools\php\$file"

echo $PSScriptRoot

try {
    echo 'attempting $url...'
    appveyor DownloadFile $url
} catch {
	echo 'attempting $archiveUrl...'
	appveyor DownloadFile $archiveUrl
}

7z x $file -oc:\tools\php
