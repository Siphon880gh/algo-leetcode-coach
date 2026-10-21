<?php
declare(strict_types=1);

return [
    'title' => 'Min Swaps to Arrange a Binary Grid: nearest qualifying row',
    'leetcode' => 1536,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: compute trailing zeros per row; for row i find the first row j ≥ i with ≥ n − 1 − i zeros, bubble it up (j − i swaps), else −1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-swaps-to-arrange-a-binary-grid',
    'tags' => ['greedy', 'matrix', 'step-by-step'],
];
