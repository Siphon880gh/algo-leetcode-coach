<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs With XOR in a Range: binary trie, count below a limit',
    'leetcode' => 1803,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: answer f(high + 1) − f(low), where f(lim) counts pairs with XOR < lim using a bit trie: at a limit bit 1, add the subtree matching x\'s bit and follow the other. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'count-pairs-with-xor-in-a-range',
    'tags' => ['trie', 'bit-manipulation', 'array', 'step-by-step'],
];
