<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game VII: sliding count of reachable predecessors',
    'leetcode' => 1871,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: maintain how many reachable indices lie in [j − maxJump, j − minJump]; j is reachable if s[j] is 0 and that count is positive. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'jump-game-vii',
    'tags' => ['sliding-window', 'prefix-sum', 'dynamic-programming', 'step-by-step'],
];
