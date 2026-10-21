<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Distance to Target Color: nearest on each side',
    'leetcode' => 1182,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sweep left to right and right to left per color, store the distances to the last and next occurrence, and answer each query with the smaller one. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'shortest-distance-to-target-color',
    'tags' => ['dynamic-programming', 'arrays', 'binary-search', 'step-by-step'],
];
