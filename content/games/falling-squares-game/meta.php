<?php
declare(strict_types=1);

return [
    'title' => 'Falling Squares',
    'leetcode' => 699,
    'difficulty' => 'Hard',
    'summary' => 'For each square [left, side], its base is the max height over [left, left + side) among landed squares (segment tree with range max/assign); its top = base + side. Report the running maximum.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'falling-squares',
    'related_session' => 'falling-squares',
];
