<?php
declare(strict_types=1);

return [
    'title' => 'XOR After Range Multiplication Queries II: split steps at √n',
    'leetcode' => 3655,
    'difficulty' => 'Hard',
    'summary' => 'Large steps touch at most √n indices, so apply them directly. For each small step k, put the factor at l and its modular inverse at the first index past r in the progression, then sweep with stride k.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'divide-and-conquer', 'prefix-sum', 'leetcode'],
    'related_session' => 'xor-after-range-multiplication-queries-ii',
];
