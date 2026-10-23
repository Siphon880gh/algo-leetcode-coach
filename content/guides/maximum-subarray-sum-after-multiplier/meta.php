<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum After Multiplier: Kadane with three states',
    'leetcode' => 3976,
    'difficulty' => 'Med',
    'summary' => 'For each operation, run Kadane with three states: before the changed part, inside it, and after it. The changed part can sit inside the summed subarray, because changing one element of it never hurts: multiply a non-negative one or divide a negative one.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-subarray-sum-after-multiplier',
];
