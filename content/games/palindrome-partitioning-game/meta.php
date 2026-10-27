<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Partitioning',
    'leetcode' => 131,
    'difficulty' => 'Med',
    'summary' => 'Backtrack over cut positions: from index i try every end j where s[i to j] is a palindrome (precompute a table), recurse from j + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'palindrome-partitioning',
    'related_session' => 'palindrome-partitioning',
];
