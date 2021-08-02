# amqp-topic-match

A utility for matching routing keys to AMQP-style topic patterns.

## Usage

```php
use \Voiciano\AMQPTopicMatch\AMQPTopicMatch;

$amqp_topic_match = new AMQPTopicMatch();

$amqp_topic_match->match("a.b.c.d", "*.b.#");    # return true
$amqp_topic_match->match("c", "#.c.#");          # return true
$amqp_topic_match->match("a.b.c.d", "*.b.c");    # return false
```