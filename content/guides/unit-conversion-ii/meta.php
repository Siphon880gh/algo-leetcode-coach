<?php
declare(strict_types=1);

return [
    'title' => 'Unit Conversion II: values relative to unit 0',
    'leetcode' => 3535,
    'difficulty' => 'Med',
    'summary' => 'The conversions form a tree. Walk it from unit 0 to get val[x] = units of x per unit of 0 (mod 10^9 + 7, using the inverse for a backward edge). One unit of a equals val[b] / val[a] units of b, so each query is val[b] · inverse(val[a]).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'graph', 'array', 'math', 'leetcode'],
    'related_session' => 'unit-conversion-ii',
];
