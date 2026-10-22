<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Walk in Weighted Graph: AND of the whole component',
    'leetcode' => 3108,
    'difficulty' => 'Hard',
    'summary' => 'A walk can repeat edges, and AND only drops bits, so the cheapest walk between two vertices of one component uses every edge there. Union-find the components, AND their edge weights, and answer −1 across components.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'union-find', 'graph', 'leetcode'],
    'related_session' => 'minimum-cost-walk-in-weighted-graph',
];
