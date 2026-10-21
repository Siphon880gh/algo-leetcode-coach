<?php
declare(strict_types=1);

return [
    'title' => 'Bricks Falling When Hit: add bricks back in reverse with union-find',
    'leetcode' => 803,
    'difficulty' => 'Hard',
    'summary' => 'Removing bricks splits components, which union-find cannot do, but adding them back merges, which it can. Apply all hits first, build components with a virtual roof node, then undo the hits in reverse; each restored brick reports how much the roof component grew, minus itself.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'graphs', 'matrix', 'leetcode'],
    'related_session' => 'bricks-falling-when-hit',
];
