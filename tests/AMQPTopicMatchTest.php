<?php

namespace Voiciano\AMQPTopicMatch\Tests;

use \PHPUnit\Framework\TestCase,
    \Voiciano\AMQPTopicMatch\AMQPTopicMatch;

class AMQPTopicMatchTest extends TestCase
{
    public function testMatchRoutingKeyInPattern(): void
    {
        $amqp_topic_match = new AMQPTopicMatch();

        $check_patterns = [
            "a.b.*" => [
                "a.b.c.d" => false,
                "a.b.c" => true,
                "c.b.a" => false,
                "a.b" => false,
            ],
            "a.*.*" => [
                "a.b.c.d" => false,
                "a.b.c" => true,
                "a.b" => false,
            ],
            "a.b.#" => [
                "a.b.c.d" => true,
                "a.b.c" => true,
                "a.b" => true,
            ],
            "#.b.#" => [
                "a.b.c.d" => true,
                "a.e.c.d" => false,
                "a.b.c" => true,
                "a.b" => true,
                "b" => true,
            ],
        ];

        foreach ($check_patterns as $pattern => $routing_keys) {
            foreach ($routing_keys as $routing_key => $expected_result_value)
            {
                $this->assertThat(
                    $amqp_topic_match->match($routing_key, $pattern),
                    $expected_result_value ? $this->isTrue() : $this->isFalse(),
                    sprintf('Routing key "%s" does not match patter "%s"', $routing_key, $pattern)
                );
            }
        }
    }
}