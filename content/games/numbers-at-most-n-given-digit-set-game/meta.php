<?php
declare(strict_types=1);

return [
    'title' => 'Numbers At Most N Given Digit Set: shorter numbers, then digit by digit',
    'leetcode' => 902,
    'difficulty' => 'Hard',
    'summary' => 'Every number with fewer digits than n works: D^L for each shorter length L. For n\'s own length, walk its digits: digits smaller than n[i] give D^(rest) each; if n[i] itself is in the set, continue, else stop. Reaching the end adds 1 (n itself).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'numbers-at-most-n-given-digit-set',
    'related_session' => 'numbers-at-most-n-given-digit-set',
];
