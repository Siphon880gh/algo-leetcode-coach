<?php
declare(strict_types=1);

return [
    'title' => 'Redundant Connection II: two parents, a cycle, or both',
    'leetcode' => 685,
    'difficulty' => 'Hard',
    'summary' => 'With directed edges, the extra edge either gives a node two parents, makes a cycle, or does both. Find the two-parent candidates first, then use union-find without the later candidate to decide.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'graphs', 'leetcode'],
    'related_session' => 'redundant-connection-ii',
];
