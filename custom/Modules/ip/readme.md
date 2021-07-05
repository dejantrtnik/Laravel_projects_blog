## Manual

```php
include "Modules/ip/ip.php";
```
### sample:
call class with
```php
$ipLocation = new IpLocation('must be ip number');
echo "<pre>";
print_r($ipLocation->lookIp());
```
### sample:\
```php
echo $ipLocation->lookIp()['country'];
```
