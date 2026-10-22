<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sized Array: separable sum, then grow n',
    'leetcode' => 3344,
    'difficulty' => 'Med',
    'summary' => 'When entry (i, j, k) is i · (j OR k), the total factors into (Σ i) · (Σ over j, k of j OR k). Grow n and update the OR sum incrementally until the total passes s.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'binary-search', 'leetcode'],
    'related_session' => 'maximum-sized-array',
];
