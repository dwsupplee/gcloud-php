$file = "php-$env:PHP_VERSION.zip"
$url = "http://windows.php.net/downloads/releases/$file"
$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$client = New-Object NET.WebClient
$projectPath = "C:\projects\google-cloud"

try {
    $client.DownloadFile($url, "$projectPath\$file")
} catch {
	$client.DownloadFile($archiveUrl, "$projectPath\$file")
}

7z x $file -oc:\tools\php
