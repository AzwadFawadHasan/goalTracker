# goalTracker
A simple goalTracker demo application using codeigniter 3.1.11 to show how to use redis for user session caching. ![](https://api.visitorbadge.io/api/VisitorHit?user=AzwadFawadHasan&repo=goalTracker&countColor=%237B1E7A)
# Installation
For Windows 10 with WAMP, manually compiling and installing the Redis extension from source isn't the recommended approach. Instead, I'd suggest these easier steps:

First, determine your exact PHP version by running:

```php -v```

For WAMP, the easiest way to install the Redis extension is to:

- Download the pre-compiled DLL file matching your PHP version from: [ https://windows.php.net/downloads/pecl/releases/redis/ ]
- Look for a file named something like ```php_redis-x.x.x-8.x-ts-vs16-x64.zip``` (where x.x.x is the Redis version and 8.x is your PHP version)
- Extract the php_redis.dll file from the zip


Once you have the DLL:

- Copy the ```php_redis.dll``` file to your PHP extensions directory (typically ```C:\wamp64\bin\php\phpX.X.X\ext```)
- Open your php.ini file (you can find it in the same PHP directory)
- Add this line: ```extension=redis```
- Restart your WAMP server

## installation (detailed for php version 8.0.26 and wamp version 3.3)
Go to [ https://windows.php.net/downloads/pecl/releases/redis/ ]
- Download the latest stable version that matches PHP 8.1 - look for ```php_redis-5.3.7-8.1-ts-vs16-x64.zip```
- Extract the zip file - you only need the ```php_redis.dll``` file
- Copy this ```php_redis.dll``` to: ```C:\wamp64\bin\php\php8.1.10\ext```
- Open your ```php.ini``` file (located at ```C:\wamp64\bin\php\php8.1.10\php.ini```)
- Add this line if it's not already there: ```extension=redis```
Restart WAMP server (right-click WAMP icon → Restart All Services)

- To verify the installation, you can run:
```php -m | findstr redis```


- Download the Redis DLL compatible with PHP 8.0.26 instead: ```php_redis-5.3.7-8.0-ts-vs16-x64.zip```
- Copy the ```php_redis.dll``` to ```C:\wamp64\bin\php\php8.0.26\ext```
- Open the correct ```php.ini``` file for WAMP: ```C:\wamp64\bin\php\php8.0.26\php.ini```
- Add the line: ```extension=redis```

To ensure you're editing the right ```php.ini``` file:

- Left-click on WAMP icon
- Go to PHP → php.ini
- This will open the exact php.ini file that WAMP is using

# setup Redis in CodeIgniter *(version 3.1.11)* for Caching



First, create a new file called redis.php in your ```application/config/``` directory with this basic configuration:

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['socket_type'] = 'tcp'; //`tcp` or `unix`
$config['socket'] = '/var/run/redis.sock'; // in case of `unix` socket type
$config['host'] = '127.0.0.1';
$config['password'] = NULL;
$config['port'] = 6379;
$config['timeout'] = 0;
```
Then in your application/config/autoload.php, add redis to the libraries array:

```php
$autoload['libraries'] = array('redis');
```
Create a Redis library file ```application/libraries/Redis.php``` :

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redis {
    private $redis;
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->config('redis');
        
        $this->redis = new Redis();
        
        // Connect to Redis
        $this->redis->connect(
            $this->CI->config->item('host'),
            $this->CI->config->item('port'),
            $this->CI->config->item('timeout')
        );

        // Authenticate if password is set
        if ($this->CI->config->item('password') !== NULL)
        {
            $this->redis->auth($this->CI->config->item('password'));
        }
    }

    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function set($key, $value, $timeout = 0)
    {
        return $this->redis->set($key, $value, $timeout);
    }

    // Add any other Redis methods you need
}
```
Now you can use Redis in your controllers like this:

```php 
class Welcome extends CI_Controller {
    public function index()
    {
        // Set a value
        $this->redis->set('test_key', 'Hello Redis!');
        
        // Get a value
        $value = $this->redis->get('test_key');
        
        echo $value; // Outputs: Hello Redis!
    }
}
```
A few important thigns to note:

Make sure Redis server is running on your machine
The default port is 6379, but you can change it in the config
If you're using password authentication, add it in the config file
You might want to add error handling around the Redis connection
