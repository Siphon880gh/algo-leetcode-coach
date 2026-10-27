<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Good Subtree Score',
    'leetcode' => 3575,
    'difficulty' => 'Hard',
    'summary' => 'A value can join only if its own digits are distinct; it then "uses" a 10-bit digit mask. For each subtree, knapsack over masks: best[mask] = max sum of chosen values whose digit masks are disjoint. maxScore[u] is the max over masks; the answer is their sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-good-subtree-score',
    'related_session' => 'maximum-good-subtree-score',
];
