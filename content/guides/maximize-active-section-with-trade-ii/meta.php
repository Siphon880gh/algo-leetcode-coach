<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Active Section with Trade II: clipped edge blocks plus a range maximum',
    'leetcode' => 3501,
    'difficulty' => 'Hard',
    'summary' => 'Each query gains the largest sum of two neighboring zero blocks inside the substring. Inner pairs are whole blocks, so a sparse table over pair sums answers them; the first and last blocks are clipped to the substring and checked by hand. The ones outside the substring still count.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'string', 'binary-search', 'leetcode'],
    'related_session' => 'maximize-active-section-with-trade-ii',
];
