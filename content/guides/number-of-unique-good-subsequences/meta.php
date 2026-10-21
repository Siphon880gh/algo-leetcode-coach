<?php
declare(strict_types=1);

return [
    'title' => 'Number of Unique Good Subsequences: count by last character',
    'leetcode' => 1987,
    'difficulty' => 'Hard',
    'summary' => 'Count distinct subsequences starting with 1, split by their last character: e1 (ending in 1) and e0 (ending in 0). Appending a 1 to every one of them (plus "1" itself) gives all distinct ones ending in 1; a 0 likewise without starting a new one. Add 1 for "0" if any zero exists.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'leetcode'],
    'related_session' => 'number-of-unique-good-subsequences',
];
