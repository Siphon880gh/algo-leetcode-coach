<?php
declare(strict_types=1);

return [
    'title' => 'House Robber V',
    'leetcode' => 3840,
    'difficulty' => 'Med',
    'summary' => 'Keep two states per house: take[i] = nums[i] + max(skip[i−1], take[i−1] if the colors differ), skip[i] = max(take[i−1], skip[i−1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'house-robber-v',
    'related_session' => 'house-robber-v',
];
