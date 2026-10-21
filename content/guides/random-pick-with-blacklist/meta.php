<?php
declare(strict_types=1);

return [
    'title' => 'Random Pick with Blacklist: remap the low blacklisted numbers',
    'leetcode' => 710,
    'difficulty' => 'Hard',
    'summary' => 'Let m = n − |blacklist| and pick uniformly in [0, m). Blacklisted numbers below m are remapped to unused whitelisted numbers in [m, n), so each pick is a single random draw plus a map lookup.',
    'category' => 'LeetCode',
    'subcategory' => 'Randomized',
    'topic' => 'LeetCode · Randomized',
    'kind' => 'algo',
    'tags' => ['randomized', 'hash-map', 'math', 'leetcode'],
    'related_session' => 'random-pick-with-blacklist',
];
