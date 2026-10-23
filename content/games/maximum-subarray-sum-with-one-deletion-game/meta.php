<?php
declare(strict_types=1);

return [
    'title' => 'Max Subarray Sum With One Deletion: kept and deleted states',
    'leetcode' => 1186,
    'difficulty' => 'Med',
    'summary' => 'keep = best sum ending here with no deletion (Kadane). del = best ending here with one deletion = max(del + x, keep before this element) (delete x).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-sum-with-one-deletion',
    'related_session' => 'maximum-subarray-sum-with-one-deletion',
];
