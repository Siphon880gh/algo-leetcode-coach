<?php
declare(strict_types=1);

return [
    'title' => 'Find the Number of Copy Arrays: shift every bound to index 0',
    'leetcode' => 3468,
    'difficulty' => 'Med',
    'summary' => 'Fixing copy[0] fixes everything: copy[i] = copy[0] + original[i] − original[0]. So each bound becomes a range for copy[0]; intersect them and count the integers.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'leetcode'],
    'related_session' => 'find-the-number-of-copy-arrays',
];
