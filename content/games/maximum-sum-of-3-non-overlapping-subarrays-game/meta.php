<?php
declare(strict_types=1);

return [
    'title' => 'Max Sum of 3 Non-Overlapping Subarrays: fix the middle window',
    'leetcode' => 689,
    'difficulty' => 'Hard',
    'summary' => 'Window sums W[i]. left[i] = best window start in 0..i, right[i] = best in i..end. For each middle start j, total = W[left[j−k]] + W[j] + W[right[j+k]].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-sum-of-3-non-overlapping-subarrays',
    'related_session' => 'maximum-sum-of-3-non-overlapping-subarrays',
];
