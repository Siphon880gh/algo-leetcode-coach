<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game II: jump when you reach the end of the current range',
    'leetcode' => 45,
    'difficulty' => 'Med',
    'summary' => 'Think BFS by ranges. Scan i, growing farthest = max(farthest, i + nums[i]). When i reaches the end of the current range, you must jump: jumps + 1, and the new range ends at farthest.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'jump-game-ii',
    'related_session' => 'jump-game-ii',
];
