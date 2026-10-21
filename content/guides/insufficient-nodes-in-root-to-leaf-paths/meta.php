<?php
declare(strict_types=1);

return [
    'title' => 'Insufficient Nodes in Root to Leaf Paths: prune after the children',
    'leetcode' => 1080,
    'difficulty' => 'Med',
    'summary' => 'Pass the path sum down. A leaf survives when its path sum reaches limit; an inner node survives only if at least one child survives after pruning.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'leetcode'],
    'related_session' => 'insufficient-nodes-in-root-to-leaf-paths',
];
