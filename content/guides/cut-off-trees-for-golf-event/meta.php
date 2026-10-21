<?php
declare(strict_types=1);

return [
    'title' => 'Cut Off Trees for Golf Event: BFS between consecutive trees',
    'leetcode' => 675,
    'difficulty' => 'Hard',
    'summary' => 'The cutting order is fixed by height, so sort the trees, BFS the shortest walk from each one to the next, and add the distances. Any unreachable tree makes it -1.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'matrix', 'sorting', 'leetcode'],
    'related_session' => 'cut-off-trees-for-golf-event',
];
