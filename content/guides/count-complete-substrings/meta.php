<?php
declare(strict_types=1);

return [
    'title' => 'Count Complete Substrings: split, then a window per distinct count',
    'leetcode' => 2953,
    'difficulty' => 'Hard',
    'summary' => 'Cut the word where adjacent letters differ by more than 2. In each piece, a complete substring with d distinct letters has length d·k; slide a window of that length for d = 1 … 26 and test the counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'sliding-window', 'leetcode'],
    'related_session' => 'count-complete-substrings',
];
