<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game IX',
    'leetcode' => 3660,
    'difficulty' => 'Med',
    'summary' => 'From i you can always reach the max of nums[0 to i] (jump back to it). If that prefix max is bigger than the min of nums[i+1..], you can cross to the right and do as well as i+1. So sweep from the right: ans[i] = ans[i+1] if prefMax[i] > sufMin[i+1], else prefMax[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'tags' => ['array', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'jump-game-ix',
    'related_session' => 'jump-game-ix',
];
