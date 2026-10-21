<?php
declare(strict_types=1);

return [
    'title' => 'Can Convert String in K Moves: shifts per residue',
    'leetcode' => 1540,
    'difficulty' => 'Med',
    'summary' => 'Each index needs shift d = (t − s) mod 26. Move i shifts by i mod 26, so the c-th index needing shift d uses move d + 26(c − 1); it must be ≤ k.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'strings', 'leetcode'],
    'related_session' => 'can-convert-string-in-k-moves',
];
