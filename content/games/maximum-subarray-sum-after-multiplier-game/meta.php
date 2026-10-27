<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum After Multiplier',
    'leetcode' => 3976,
    'difficulty' => 'Med',
    'summary' => 'Kadane with three phases: before the operated block, inside it, after it. Inside, each element contributes x times k (or x divided by k, rounded toward zero). Run it once for multiply and once for divide, and take the best non-empty sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-sum-after-multiplier',
    'related_session' => 'maximum-subarray-sum-after-multiplier',
];
