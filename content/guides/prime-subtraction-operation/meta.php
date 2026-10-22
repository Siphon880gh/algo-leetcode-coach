<?php
declare(strict_types=1);

return [
    'title' => 'Prime Subtraction Operation: smallest value above the previous',
    'leetcode' => 2601,
    'difficulty' => 'Med',
    'summary' => 'Go left to right and make each value as small as possible while staying above the previous one: subtract the largest prime p < nums[i] that keeps nums[i] − p > prev. If even the original value is not above prev, fail.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'binary-search', 'greedy', 'number-theory', 'leetcode'],
    'related_session' => 'prime-subtraction-operation',
];
