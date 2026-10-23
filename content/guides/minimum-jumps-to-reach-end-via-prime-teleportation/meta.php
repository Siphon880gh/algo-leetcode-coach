<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Jumps to Reach End via Prime Teleportation: BFS with prime buckets',
    'leetcode' => 3629,
    'difficulty' => 'Med',
    'summary' => 'BFS from index 0. Bucket every index under each prime factor of its value. From a prime value p, jump to every index in bucket p, then empty the bucket so it is used once.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'array', 'hash-table', 'math', 'number-theory', 'leetcode'],
    'related_session' => 'minimum-jumps-to-reach-end-via-prime-teleportation',
];
