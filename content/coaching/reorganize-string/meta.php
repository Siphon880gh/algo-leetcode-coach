<?php
declare(strict_types=1);

return [
    'title' => 'Reorganize String: even slots first',
    'leetcode' => 767,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: check that no letter exceeds ceil(n / 2), then fill even indexes and then odd ones in order of decreasing count. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'reorganize-string',
    'tags' => ['greedy', 'heap', 'counting', 'strings', 'step-by-step'],
];
