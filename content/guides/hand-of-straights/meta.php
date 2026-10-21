<?php
declare(strict_types=1);

return [
    'title' => 'Hand of Straights: start each group at the smallest card left',
    'leetcode' => 846,
    'difficulty' => 'Med',
    'summary' => 'The smallest remaining card must begin a group, since nothing smaller can precede it. Repeatedly take it and consume one of each of the next groupSize − 1 values, failing if any is missing.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-map', 'sorting', 'leetcode'],
    'related_session' => 'hand-of-straights',
];
