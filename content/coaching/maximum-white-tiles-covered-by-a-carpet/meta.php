<?php
declare(strict_types=1);

return [
    'title' => 'Maximum White Tiles Covered by a Carpet: start at a tile',
    'leetcode' => 2271,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: try only tile starts, add the partial overlap of the next tile, and sort the tiles first. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'maximum-white-tiles-covered-by-a-carpet',
    'tags' => ['array', 'binary-search', 'greedy', 'sorting', 'prefix-sum', 'sliding-window', 'step-by-step'],
];
