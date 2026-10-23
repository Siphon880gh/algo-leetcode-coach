<?php
declare(strict_types=1);

return [
    'title' => 'Max Subarray Sum After One Squaring: used or not used',
    'leetcode' => 1746,
    'difficulty' => 'Med',
    'summary' => 'no = best sum ending here with no square used (Kadane); yes = best ending here with the square used = max(no_prev + x², yes_prev + x, x²).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-sum-after-one-operation',
    'related_session' => 'maximum-subarray-sum-after-one-operation',
];
