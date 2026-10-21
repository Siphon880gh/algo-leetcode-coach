<?php
declare(strict_types=1);

return [
    'title' => 'Kth Smallest Instructions: count paths per choice',
    'leetcode' => 1643,
    'difficulty' => 'Hard',
    'summary' => 'Build the string greedily. Placing H first leaves C(h − 1 + v, v) paths; if k is within that, write H, else write V and subtract that count from k.',
    'category' => 'LeetCode',
    'subcategory' => 'Combinatorics',
    'topic' => 'LeetCode · Combinatorics',
    'kind' => 'algo',
    'tags' => ['combinatorics', 'math', 'leetcode'],
    'related_session' => 'kth-smallest-instructions',
];
