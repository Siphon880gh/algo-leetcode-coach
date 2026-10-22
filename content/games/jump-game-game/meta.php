<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game: track the farthest reachable index',
    'leetcode' => 55,
    'difficulty' => 'Med',
    'summary' => 'Walk left to right keeping farthest = max(farthest, i + nums[i]). If you ever stand at an i beyond farthest, you are stuck. Once farthest reaches the last index, you can win.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'jump-game',
    'related_session' => 'jump-game',
];
