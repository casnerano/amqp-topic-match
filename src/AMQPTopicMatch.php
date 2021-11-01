<?php declare(strict_types = 1);

namespace Casnerano\AMQPTopicMatch;

class AMQPTopicMatch
{
    public function match(string $routing_key, string $topic_pattern): bool
    {
        $regex_pattern = str_replace('*', '([^.]+)', $topic_pattern);
        $regex_pattern = str_replace('.#', '(\.[^.]+)*', $regex_pattern);
        $regex_pattern = str_replace('#.', '([^.]+\.)*', $regex_pattern);

        $regex_pattern = sprintf('#^%s$#', $regex_pattern);

        return 1 === preg_match($regex_pattern, $routing_key);
    }
}
