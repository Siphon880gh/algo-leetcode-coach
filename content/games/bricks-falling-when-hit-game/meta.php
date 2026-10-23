<?php
declare(strict_types=1);

return [
    'title' => 'Bricks Falling When Hit',
    'leetcode' => 803,
    'difficulty' => 'Hard',
    'summary' => 'Work in reverse: remove all hit bricks, union the remaining ones (with a virtual roof node for row 0), then add hits back from last to first; the growth of the roof component minus the re-added brick is how many fell.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'bricks-falling-when-hit',
    'related_session' => 'bricks-falling-when-hit',
];
