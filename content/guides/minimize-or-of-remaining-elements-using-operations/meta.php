<?php
declare(strict_types=1);

return [
    'title' => 'Minimize OR of Remaining Elements Using Operations: decide bits from the top',
    'leetcode' => 3022,
    'difficulty' => 'Hard',
    'summary' => 'Go from the highest bit down, keeping a mask of bits you want to be 0 in the answer. Test adding bit b: greedily merge left to right, closing a group as soon as its AND has none of the masked bits; the merges used are n minus the groups. Keep b if that is at most k.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'array', 'leetcode'],
    'related_session' => 'minimize-or-of-remaining-elements-using-operations',
];
