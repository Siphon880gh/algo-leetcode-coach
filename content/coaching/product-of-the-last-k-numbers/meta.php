<?php
declare(strict_types=1);

return [
    'title' => 'Product of the Last K Numbers: prefix products with zero reset',
    'leetcode' => 1352,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep prefix products since the last zero, reset on zero, and answer with a division, or 0 when k reaches past the last zero. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'product-of-the-last-k-numbers',
    'tags' => ['design', 'prefix-sum', 'step-by-step'],
];
