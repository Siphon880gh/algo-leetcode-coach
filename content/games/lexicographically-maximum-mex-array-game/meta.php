<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Maximum MEX Array',
    'leetcode' => 3948,
    'difficulty' => 'Hard',
    'summary' => 'The first value can be at most the MEX of everything left, so cut the shortest prefix that reaches it, which leaves the most behind for later. When the remaining MEX is 0, every cut gives 0 and a longer result wins, so cut one element at a time.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'lexicographically-maximum-mex-array',
    'related_session' => 'lexicographically-maximum-mex-array',
];
