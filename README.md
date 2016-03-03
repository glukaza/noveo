### Cart API
-- Test working for Noveo

### Version
0.0.1

### Data Source
data store in condig/data.php file

### Configure
in config/config.php we can set:
- root_url:  /api/
- mapping:  url/http_method/action

### GitHub Repo
git clone git@github.com:glukaza/noveo.git

### Docker Image
you can build image:
```
docker build -t my-noveo ./
docker run -d --name noveo my-noveo
```

Or simply start container from my image
```
docker run -d --name noveo glukaza/noveo
```

### Test
```
curl -X GET -b PHPSESSID=123 http://test.url/api/products
curl -X POST -b PHPSESSID=123 http://test.url/api/cart --data "product_id=1&quantity=1"
curl -X DELETE -b PHPSESSID=123 http://test.url/api/cart/1
curl -X GET -b PHPSESSID=123 http://test.url/api/cart
```