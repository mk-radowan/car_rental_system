# Downloads real car photos from Wikimedia Commons
$dir = "$PSScriptRoot\public\images\cars\models"
New-Item -ItemType Directory -Path $dir -Force | Out-Null
$ua = "PothikCarRental/1.0"

$queries = @{
    "maruti-suzuki-swift" = "Maruti Suzuki Swift 2024 India"
    "hyundai-i20" = "Hyundai i20 India front"
    "tata-altroz" = "Tata Altroz India front"
    "honda-city" = "Honda City India sedan front"
    "hyundai-verna" = "Hyundai Verna India front"
    "maruti-suzuki-ciaz" = "Maruti Suzuki Ciaz India front"
    "mahindra-scorpio" = "Mahindra Scorpio N India front"
    "tata-harrier" = "Tata Harrier India front"
    "hyundai-creta" = "Hyundai Creta India front"
    "mahindra-xuv700" = "Mahindra XUV700 India front"
    "bmw-x1" = "BMW X1 India front"
    "mercedes-c-class" = "Mercedes C Class W206 front"
    "audi-a4" = "Audi A4 sedan front"
    "bmw-z4" = "BMW Z4 roadster front"
    "mini-cooper" = "Mini Cooper F56 front"
    "tata-nexon-ev" = "Tata Nexon EV India front"
    "mg-zs-ev" = "MG ZS EV India front"
}

function Search-WikiImage($query) {
    $q = [uri]::EscapeDataString($query)
    $json = curl.exe -s "https://commons.wikimedia.org/w/api.php?action=query&generator=search&gsrsearch=$q&gsrnamespace=6&gsrlimit=8&prop=imageinfo&iiprop=url|mime&iiurlwidth=800&format=json" -A $ua
    foreach ($m in [regex]::Matches($json, '"mime":"(image/[^"]+)".*?"thumburl":"([^"]+)"', 'Singleline')) {
        return @{ ext = if ($m.Groups[1].Value -match 'png') { 'png' } else { 'jpg' }; url = $m.Groups[2].Value }
    }
    foreach ($m in [regex]::Matches($json, '"thumburl":"(https://upload\.wikimedia\.org[^"]+\.(?:jpg|jpeg|png))"')) {
        $url = $m.Groups[1].Value
        $ext = if ($url -match '\.png') { 'png' } else { 'jpg' }
        return @{ ext = $ext; url = $url }
    }
    return $null
}

$ok = 0
foreach ($slug in $queries.Keys) {
    $result = Search-WikiImage $queries[$slug]
    if (-not $result) {
        Write-Host "SKIP $slug"
        continue
    }
    $out = Join-Path $dir "$slug.$($result.ext)"
    curl.exe -sL -A $ua -o $out $result.url
    if ((Test-Path $out) -and (Get-Item $out).Length -gt 8000) {
        Write-Host "OK  $slug ($($result.ext))"
        $ok++
    } else {
        Remove-Item $out -ErrorAction SilentlyContinue
        Write-Host "FAIL $slug"
    }
}

Write-Host "`nDownloaded $ok / $($queries.Count) real car photos."
if ($ok -gt 0) { Write-Host "Run: php artisan cars:sync-images" }
