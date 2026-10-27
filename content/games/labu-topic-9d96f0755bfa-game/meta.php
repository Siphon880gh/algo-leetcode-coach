<?php
declare(strict_types=1);

return [
    'title' => 'Cost of Recursion: Calls and Depth',
    'summary' => 'Time follows how many calls do work; space follows the deepest chain of open calls. sum(n) = n + sum(n − 1) with sum(1) = 1 makes n calls with depth n. Naive fib(n) = fib(n − 1) + fib(n − 2) with fib(0) and fib(1) as base cases makes an exploding number of calls but still has depth only n.',
    'category' => 'Algorithms',
    'subcategory' => 'Recursion',
    'topic' => 'Algorithms · Recursion',
    'tags' => ['recursion', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-topic-9d96f0755bfa',
    'related_session' => 'labu-topic-9d96f0755bfa',
];
