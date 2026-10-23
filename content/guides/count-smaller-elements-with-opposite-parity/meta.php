<?php
declare(strict_types=1);

return [
    'title' => 'Count Smaller Elements With Opposite Parity: two Fenwick trees from the right',
    'leetcode' => 3907,
    'difficulty' => 'Med',
    'summary' => 'Scan from the right, keeping one Fenwick tree for even values and one for odd. For each element, ask the other parity’s tree how many smaller values it holds.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'count-smaller-elements-with-opposite-parity',
];
