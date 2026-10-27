<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Weights With Degree at most k: gains DP',
    'leetcode' => 3367,
    'difficulty' => 'Hard',
    'summary' => 'For each node: base = the sum of keep-free values of children; gains = (child-with-edge value + w − child free value). Take the best positive gains: up to k − 1 if the parent edge is kept, up to k if not.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-sum-of-weights-after-edge-removals',
    'related_session' => 'maximize-sum-of-weights-after-edge-removals',
];
