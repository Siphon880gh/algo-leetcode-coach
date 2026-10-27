<?php
declare(strict_types=1);

return [
    'title' => 'Change Minimum Characters to Satisfy One of Three Conditions',
    'leetcode' => 1737,
    'difficulty' => 'Med',
    'summary' => 'Count letters of a and b. For each boundary letter c (b to z): a < c at most b costs (a letters at least c) + (b letters < c), and symmetric. Condition 3 costs |a| + |b| − (max count of a letter in a) − (in b). Prefix sums of counts make each boundary O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'change-minimum-characters-to-satisfy-one-of-three-conditions',
    'related_session' => 'change-minimum-characters-to-satisfy-one-of-three-conditions',
];
