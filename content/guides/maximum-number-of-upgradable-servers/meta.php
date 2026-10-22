<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Upgradable Servers: one inequality per center',
    'leetcode' => 3155,
    'difficulty' => 'Med',
    'summary' => 'Upgrading x servers means selling the rest: (count − x) · sell + money ≥ x · upgrade. So x = min(count, ⌊(count · sell + money) / (upgrade + sell)⌋).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'binary-search', 'leetcode'],
    'related_session' => 'maximum-number-of-upgradable-servers',
];
