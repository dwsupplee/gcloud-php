$file = "php-$env:PHP_VERSION.zip"
$url = "http://windows.php.net/downloads/releases/$file"
$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$client = New-Object NET.WebClient
$path = "C:\tools\php\$file"

try {
    $client.DownloadFile($url, $path)
} catch {
    echo $archiveUrl
	echo $path
	$client.DownloadFile($archiveUrl, $path)
}

7z x $path -oc:\tools\php
