<?php
declare(strict_types=1);

return [
    'title' => 'Broken Calculator: work backward from the target',
    'leetcode' => 991,
    'difficulty' => 'Med',
    'summary' => 'Going backward, the operations become halving and adding 1. While target is larger than startValue, halve it when even and add 1 when odd; then close the remaining gap with startValue − target subtractions.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'math', 'leetcode'],
    'related_session' => 'broken-calculator',
];
