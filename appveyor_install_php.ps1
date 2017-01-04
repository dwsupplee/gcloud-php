$file = "php-$env:PHP_VERSION.zip"
$url = "http://windows.php.net/downloads/releases/$file"
$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$client = New-Object NET.WebClient

try {
    $client.DownloadFile($url, "C:\tools\php\$file")
} catch {
	$client.DownloadFile($archiveUrl, "C:\tools\php\$file")
}

7z x C:\tools\php\$file -oc:\tools\php
