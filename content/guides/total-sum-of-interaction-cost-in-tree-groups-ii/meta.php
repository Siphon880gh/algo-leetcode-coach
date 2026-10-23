<?php
declare(strict_types=1);

return [
    'title' => 'Total Sum of Interaction Cost in Tree Groups II: edge contributions with small-to-large',
    'leetcode' => 4018,
    'difficulty' => 'Hard',
    'summary' => 'The edge above node v is on the path of a same-group pair when exactly one node is inside v\'s subtree. So it adds Σ over groups of c[g] · (total[g] − c[g]), where c counts the subtree. Merge the subtree count maps small into large and keep that sum up to date.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'sorting', 'leetcode'],
    'related_session' => 'total-sum-of-interaction-cost-in-tree-groups-ii',
];
