<?php
declare(strict_types=1);

return [
    'title' => 'Count of Monotonic Pairs I: arr1 rises, arr2 falls',
    'leetcode' => 3250,
    'difficulty' => 'Hard',
    'summary' => 'Pick arr1[i] = v (arr2[i] = nums[i] − v). Need u ≤ v and nums[i−1] − u ≥ nums[i] − v, i.e. u ≤ v − max(0, nums[i] − nums[i−1]). dp with prefix sums over v.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-count-of-monotonic-pairs-i',
    'related_session' => 'find-the-count-of-monotonic-pairs-i',
];
