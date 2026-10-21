<?php
declare(strict_types=1);

return [
    'title' => 'Redundant Connection: the first edge that closes a cycle',
    'leetcode' => 684,
    'difficulty' => 'Med',
    'summary' => 'Add edges in order with union-find. The first edge whose two ends are already connected closes the only cycle, and it is also the last cycle edge in the input.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'graphs', 'leetcode'],
    'related_session' => 'redundant-connection',
];
