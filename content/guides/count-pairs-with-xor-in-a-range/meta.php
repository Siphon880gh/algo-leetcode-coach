<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs With XOR in a Range: binary trie, count below a limit',
    'leetcode' => 1803,
    'difficulty' => 'Hard',
    'summary' => 'Answer = pairs with XOR < high + 1 minus pairs with XOR < low. Count "XOR < lim" by inserting numbers into a bit trie and, for each new number, walking the limit\'s bits: where the limit has a 1, every number in the branch matching x\'s bit gives XOR 0 there and counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'bit-manipulation', 'array', 'leetcode'],
    'related_session' => 'count-pairs-with-xor-in-a-range',
];
