<?php
declare(strict_types=1);

return [
    'title' => 'Friends Of Appropriate Ages: count by age, not by person',
    'leetcode' => 825,
    'difficulty' => 'Med',
    'summary' => 'Ages are between 1 and 120, so count people per age and test each pair of ages once: a sends to b unless b ≤ 0.5 · a + 7 or b > a. Add count[a] · count[b], subtracting the self-requests when a == b.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'counting', 'sorting', 'leetcode'],
    'related_session' => 'friends-of-appropriate-ages',
];
