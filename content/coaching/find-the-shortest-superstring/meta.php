<?php
declare(strict_types=1);

return [
    'title' => 'Find the Shortest Superstring: maximize total overlap',
    'leetcode' => 943,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: precompute pairwise overlaps, run a bitmask DP for the order with the most overlap ending at each word, and rebuild the string from parents. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'find-the-shortest-superstring',
    'tags' => ['dynamic-programming', 'bitmask', 'strings', 'step-by-step'],
];
