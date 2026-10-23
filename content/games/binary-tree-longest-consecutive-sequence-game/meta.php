<?php
declare(strict_types=1);

return [
    'title' => 'Longest Consecutive Path: extend when child = parent + 1',
    'leetcode' => 298,
    'difficulty' => 'Med',
    'summary' => 'DFS with the current run length: if child.val = parent.val + 1 extend the run, otherwise restart at 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'binary-tree-longest-consecutive-sequence',
    'related_session' => 'binary-tree-longest-consecutive-sequence',
];
