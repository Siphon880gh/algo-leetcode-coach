<?php
declare(strict_types=1);

return [
    'title' => 'Find All Good Strings: count at most s2 minus count < s1, avoiding evil',
    'leetcode' => 1397,
    'difficulty' => 'Hard',
    'summary' => 'Digit DP over positions with the KMP state of how much of evil is matched. count(bound) = strings at most bound avoiding evil. Answer = count(s2) − count(s1) + (s1 is good).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-all-good-strings',
    'related_session' => 'find-all-good-strings',
];
