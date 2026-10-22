<?php
declare(strict_types=1);

return [
    'title' => 'Find the Number of Ways to Place People II: same sweep, larger n',
    'leetcode' => 3027,
    'difficulty' => 'Hard',
    'summary' => 'Same task as part I with n up to 1,000 and large coordinates. Sort by x ascending, y descending, and for each Alice scan later points, counting each Bob whose y is at most hers and above every earlier qualifying y.',
    'category' => 'LeetCode',
    'subcategory' => 'Geometry',
    'topic' => 'LeetCode · Geometry',
    'kind' => 'algo',
    'tags' => ['geometry', 'array', 'math', 'enumeration', 'sorting', 'leetcode'],
    'related_session' => 'find-the-number-of-ways-to-place-people-ii',
];
