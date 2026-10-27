<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score Keeping the Tree Healthy',
    'leetcode' => 2925,
    'difficulty' => 'Med',
    'summary' => 'Take everything except what must stay. keep(u) = values[u] for a leaf, else min(values[u], the sum of keep(children)). Answer = total − keep(root).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-score-after-applying-operations-on-a-tree',
    'related_session' => 'maximum-score-after-applying-operations-on-a-tree',
];
