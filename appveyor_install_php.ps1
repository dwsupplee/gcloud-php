$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$url = "http://windows.php.net/downloads/releases/$file"
$file = "php-$env:PHP_VERSION.zip"
$projectPath = "C:\projects\google-cloud"
$client = New-Object NET.WebClient

try {
	echo $url
    $client.DownloadFile($url, "$projectPath\$file")
} catch {
	$client.DownloadFile($archiveUrl, "$projectPath\$file")
}

7z x $file -oc:\tools\php
