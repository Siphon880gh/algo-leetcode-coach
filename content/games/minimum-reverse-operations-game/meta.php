<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Reverse Operations',
    'leetcode' => 2612,
    'difficulty' => 'Hard',
    'summary' => 'BFS over positions of the 1. From i, reversing [L, L+k−1] moves it to 2L + k − 1 − i for valid L; those targets share parity, so keep unvisited positions in two ordered sets (or union-find "next" pointers) and remove them as they are reached.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-reverse-operations',
    'related_session' => 'minimum-reverse-operations',
];
