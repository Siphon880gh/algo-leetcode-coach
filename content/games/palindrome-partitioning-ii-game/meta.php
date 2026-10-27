<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Partitioning II: the last piece is a palindrome',
    'leetcode' => 132,
    'difficulty' => 'Hard',
    'summary' => 'cuts[i] = fewest cuts for s[0 to i]. If s[0 to i] is a palindrome, 0. Otherwise try every palindrome s[j to i] as the last piece: cuts[j−1] + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'palindrome-partitioning-ii',
    'related_session' => 'palindrome-partitioning-ii',
];
