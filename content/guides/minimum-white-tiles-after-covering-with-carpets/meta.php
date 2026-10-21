<?php
declare(strict_types=1);

return [
    'title' => 'Minimum White Tiles After Covering With Carpets: lay or skip',
    'leetcode' => 2209,
    'difficulty' => 'Hard',
    'summary' => 'f(i, j) = fewest visible white tiles from tile i with j carpets left: leave tile i uncovered (add its colour) or start a carpet there and jump to i + carpetLen.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-white-tiles-after-covering-with-carpets',
];
