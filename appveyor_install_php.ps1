$file = "php-$env:PHP_VERSION.zip"
$projectPath = "C:\projects\google-cloud"
$url = "http://windows.php.net/downloads/releases/$file"
$archiveUrl = "http://windows.php.net/downloads/releases/archives/$file"
$client = New-Object NET.WebClient

try {
    $client.DownloadFile($url, "$projectPath\$file")
} catch {
	$client.DownloadFile($archiveUrl, "$projectPath\$file")
}
