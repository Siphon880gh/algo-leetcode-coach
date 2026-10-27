<?php
declare(strict_types=1);

return [
    'title' => 'Number of Unique Good Subsequences: count by last digit',
    'leetcode' => 1987,
    'difficulty' => 'Hard',
    'summary' => 'end0 and end1 = distinct good subsequences (starting with 1) ending in 0 or 1. A "1": end1 = end0 + end1 + 1. A "0": end0 = end0 + end1. Add 1 at the end if any 0 exists ("0" itself).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-unique-good-subsequences',
    'related_session' => 'number-of-unique-good-subsequences',
];
