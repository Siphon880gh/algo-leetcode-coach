<?php
declare(strict_types=1);

return [
    'title' => 'Friends of Appropriate Ages: count by age',
    'leetcode' => 825,
    'difficulty' => 'Med',
    'summary' => 'Count people per age. x sends to y unless age[y] at most 0.5 times age[x] + 7, age[y] > age[x], or (age[y] > 100 and age[x] < 100). Pairs of ages a, b give cnt[a] times (cnt[b] − [a = b]) requests.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'friends-of-appropriate-ages',
    'related_session' => 'friends-of-appropriate-ages',
];
