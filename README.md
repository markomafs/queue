# Queue
A PHP Lib for Handle Queue 


### How to publish a Message

```php

require_once __DIR__ . '/vendor/autoload.php';

use Queue\Configuration;
use Queue\Driver;
use Queue\DriverManager;
use QueueTest\Fake\ProducerFake;

$configuration = new Configuration(Driver::AMQP, 'rabbit.kanui.dev', 5672, 'kanui', 'kanui');

$connection = DriverManager::getConnection($configuration);

$queue = new ProducerFake($connection);

$mesage = $queue->prepare(123);

$queue->publish($message);
```