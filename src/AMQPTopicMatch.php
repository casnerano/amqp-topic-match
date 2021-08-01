<?php declare(strict_types = 1);

namespace Voiciano\AMQPTopicMatch;

class AMQPTopicMatch
{
    public function match(string $routing_key, string $topic_pattern): bool
    {

    }

    public function topicPattern2Regex(string $topic_pattern): string {
        return sprintf(
            "^%s$",
            str_replace(
                ["*", ".#", "#."],
                ["([^.]+)", "(\.[^.]+)*", "([^.]+\.)*"],
                $topic_pattern
            )
        );
    }
}