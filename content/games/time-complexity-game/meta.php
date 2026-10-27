<?php
declare(strict_types=1);

return [
    'title' => 'Time Complexity: Count the Work',
    'summary' => 'Count how many times the innermost line runs as a function of n, then keep only the fastest-growing term and drop constants. Three nested loops of n run n³ times: O(n³). A loop j < i inside i < n runs n(n − 1) divided by 2 times: O(n²). Halving i until it reaches 1 runs about log₂ n times: O(log n).',
    'category' => 'Algorithms',
    'subcategory' => 'Math',
    'topic' => 'Algorithms · Math',
    'tags' => ['math', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'time-complexity',
    'related_session' => 'time-complexity',
];
