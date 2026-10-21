<?php
declare(strict_types=1);

return [
    'title' => 'The Number of Weak Characters in the Game: sort and track max defense',
    'leetcode' => 1996,
    'difficulty' => 'Med',
    'summary' => 'Sort by attack descending, defense ascending within equal attack. Scanning, a character is weak if its defense is below the maximum defense seen so far, which can only come from a strictly higher attack.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'greedy', 'array', 'leetcode'],
    'related_session' => 'the-number-of-weak-characters-in-the-game',
];
