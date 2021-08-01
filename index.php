<?php

use Voiciano\AMQPTopicMatch\AMQPTopicMatch;

require_once "vendor/autoload.php";

$atm = new AMQPTopicMatch();

dd($atm->topicPattern2Regex("#.#.key"));