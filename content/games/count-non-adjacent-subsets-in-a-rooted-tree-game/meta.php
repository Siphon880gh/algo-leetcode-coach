<?php
declare(strict_types=1);

return [
    'title' => 'Count Non-Adjacent Subsets in a Rooted Tree',
    'leetcode' => 3939,
    'difficulty' => 'Hard',
    'summary' => 'Tree DP keyed by residue: in[v][r] counts subsets of v\'s subtree that take v and sum to r mod k, out[v][r] those that skip v. Children merge by convolving residues: take v and the children must be out; skip v and the children may be either. Answer out[0][0] + in[0][0] − 1 (drop the empty set).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-non-adjacent-subsets-in-a-rooted-tree',
    'related_session' => 'count-non-adjacent-subsets-in-a-rooted-tree',
];
