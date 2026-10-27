<?php
declare(strict_types=1);

return [
    'title' => 'Wiggle Sort: fix each neighbor pair as you go',
    'leetcode' => 280,
    'difficulty' => 'Med',
    'summary' => 'Walk i = 1 … n−1. At odd i we need nums[i] at least nums[i−1], at even i nums[i] at most nums[i−1]; swap when violated. Swapping never breaks the previous pair.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'wiggle-sort',
    'related_session' => 'wiggle-sort',
];
