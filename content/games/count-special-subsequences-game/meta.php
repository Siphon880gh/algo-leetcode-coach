<?php
declare(strict_types=1);

return [
    'title' => 'Count Special Subsequences: equal ratios with gaps',
    'leetcode' => 3404,
    'difficulty' => 'Med',
    'summary' => 'nums[p] times nums[r] = nums[q] times nums[s] exactly when nums[p] divided by nums[q] = nums[s] divided by nums[r]. For each r, add ratios nums[p] divided by nums[q] with q = r − 2 into a map, then look up nums[s] divided by nums[r] for s at least r + 2 (gaps of at least 2 everywhere).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-special-subsequences',
    'related_session' => 'count-special-subsequences',
];
