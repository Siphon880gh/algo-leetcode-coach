<?php
declare(strict_types=1);

return [
    'title' => 'Number of Boomerangs: per center, count equal distances',
    'leetcode' => 447,
    'difficulty' => 'Med',
    'summary' => 'Count ordered triples (i, j, k) with dist(i, j) = dist(i, k). For each center i, count squared distances to every other point in a hash map. A distance shared by c points gives c(c − 1) ordered pairs. [[0,0],[1,0],[2,0]] → 2. Use squared distance, no sqrt. Not 356.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'math', 'geometry', 'leetcode'],
    'related_session' => 'number-of-boomerangs',
];
