<?php
declare(strict_types=1);

return [
    'title' => 'Largest Divisible Subset: sort, then extend chains',
    'leetcode' => 368,
    'difficulty' => 'Med',
    'summary' => 'Sort. dp[i] = longest chain ending at nums[i] where each number divides the next: 1 + max dp[j] over j < i with nums[i] % nums[j] == 0. Follow parents back to rebuild it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'largest-divisible-subset',
    'related_session' => 'largest-divisible-subset',
];
