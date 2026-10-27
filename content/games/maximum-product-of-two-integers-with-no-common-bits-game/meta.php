<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of Two Integers With No Common Bits',
    'leetcode' => 3670,
    'difficulty' => 'Med',
    'summary' => 'SOS DP: best[mask] = largest value whose bits fit inside mask (spread each value up through its supermasks). For each x the best partner is best[~x & FULL]; take the largest product.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bits', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-product-of-two-integers-with-no-common-bits',
    'related_session' => 'maximum-product-of-two-integers-with-no-common-bits',
];
