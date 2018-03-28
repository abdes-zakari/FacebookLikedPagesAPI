#ID Facebook liked pages 


Get all ID liked pages on Facebook without pagination using graph.facebook.com.


## Installing

```bash
git clone https://github.com/abdes-zakari/FacebookLikedPagesAPI.git
```

## Sample Usage

					
```php
<?php
require('Likes.php');

$access_token = '';// your access token here

$likes=new Likes();
$result=$likes->getAllLikedPages($access_token);
echo "<pre>";
print_r($result);

```
