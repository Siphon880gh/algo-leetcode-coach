<?php
declare(strict_types=1);

return [
    'title' => 'Insufficient Nodes in Root to Leaf Paths: prune bottom-up',
    'leetcode' => 1080,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: carry the path sum down, keep a leaf only if its sum reaches limit, and drop an inner node when both of its children are gone after pruning. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'insufficient-nodes-in-root-to-leaf-paths',
    'tags' => ['trees', 'dfs', 'step-by-step'],
];
