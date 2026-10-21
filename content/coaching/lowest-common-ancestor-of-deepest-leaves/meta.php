<?php
declare(strict_types=1);

return [
    'title' => 'Lowest Common Ancestor of Deepest Leaves: heights decide',
    'leetcode' => 1123,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each call returns its height and the answer inside it; equal child heights make the node the answer, otherwise the deeper side\'s answer wins. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'lowest-common-ancestor-of-deepest-leaves',
    'tags' => ['trees', 'dfs', 'step-by-step'],
];
