<?php
declare(strict_types=1);

return [
    'title' => 'Find Longest Self-Contained Substring: start at a first occurrence',
    'leetcode' => 3104,
    'difficulty' => 'Hard',
    'summary' => 'A self-contained substring starts at the first occurrence of its first letter, so there are at most 26 starts. From each, extend right, tracking the farthest last occurrence; stop if a letter first appeared before the start. Whenever the end equals that farthest point, it is a candidate.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'leetcode'],
    'related_session' => 'find-longest-self-contained-substring',
];
