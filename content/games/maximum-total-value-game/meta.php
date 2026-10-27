<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Value',
    'leetcode' => 3971,
    'difficulty' => 'Hard',
    'summary' => 'Each index offers a decreasing sequence value, value − decay, …. Taking the m largest terms overall is optimal (stop at negatives). Binary search the cutoff value v such that at least m terms are ≥ v, add the arithmetic sums of the terms above it, and fill the rest with v.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-total-value',
    'related_session' => 'maximum-total-value',
];
