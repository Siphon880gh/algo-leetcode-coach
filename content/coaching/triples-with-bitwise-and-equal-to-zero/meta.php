<?php
declare(strict_types=1);

return [
    'title' => 'Triples with Bitwise AND Equal To Zero: pairs, then the third',
    'leetcode' => 982,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count the AND of every ordered pair into 2¹⁶ buckets, then for each k add the counts of buckets m with m & k == 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'triples-with-bitwise-and-equal-to-zero',
    'tags' => ['bit-manipulation', 'hash-table', 'step-by-step'],
];
