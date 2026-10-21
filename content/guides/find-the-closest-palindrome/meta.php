<?php
declare(strict_types=1);

return [
    'title' => 'Find the Closest Palindrome: a few mirrored candidates',
    'leetcode' => 564,
    'difficulty' => 'Hard',
    'summary' => 'Nearest palindrome to n (not n itself), smaller on ties. Only a few candidates matter: 10^(L−1) − 1 (all 9s), 10^L + 1 (1 0…0 1), and the left half (prefix) minus 1, as is, and plus 1, each mirrored. Exclude n and pick the smallest |diff|, then smallest value. "123" → "121". "1" → "0". "99" → "101".',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'strings', 'leetcode'],
    'related_session' => 'find-the-closest-palindrome',
];
