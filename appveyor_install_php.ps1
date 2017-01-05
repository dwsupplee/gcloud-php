$file = "php-$env:PHP_VERSION.zip"
$url = "http://windows.php.net/downloads/releases/$file"
$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$client = New-Object NET.WebClient
$path = "C:\tools\php\$file"

try {
appveyor DownloadFile http://windows.php.net/downloads/releases/archives/php-$env:PHP_VERSION.zip
    $client.DownloadFile($url, "C:\projects\google-cloud\$file")
} catch {
	$client.DownloadFile($archiveUrl, "C:\projects\google-cloud\$file")
}

7z x $path -oc:\tools\php
