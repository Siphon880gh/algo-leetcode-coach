<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Divide Array into Subarrays',
    'leetcode' => 3500,
    'difficulty' => 'Hard',
    'summary' => 'The k · i term telescopes: starting a new piece at l adds k × (cost of everything from l to the end). So dp[i] = min over j of dp[j] + pre[i] × (cost[j..i−1]) + k × (cost[j..n−1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-divide-array-into-subarrays',
    'related_session' => 'minimum-cost-to-divide-array-into-subarrays',
];
