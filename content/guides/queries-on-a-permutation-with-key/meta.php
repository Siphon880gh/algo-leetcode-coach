<?php
declare(strict_types=1);

return [
    'title' => 'Queries on a Permutation With Key: move to front',
    'leetcode' => 1409,
    'difficulty' => 'Med',
    'summary' => 'Keep the permutation [1..m]. For each query, report the current index of the value and move it to the front. With small m a list works; a Fenwick tree over positions makes it O(log) per query.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['simulation', 'fenwick-tree', 'leetcode'],
    'related_session' => 'queries-on-a-permutation-with-key',
];
