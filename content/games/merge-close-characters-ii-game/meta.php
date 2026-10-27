<?php
declare(strict_types=1);

return [
    'title' => 'Merge Close Characters II',
    'leetcode' => 4019,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right building the result. Remember where each letter last appeared in the result; a new character is merged away (dropped) if the same letter sits within k positions before it in the result, otherwise append it. Since removals shift later indices left, distances use result positions.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'merge-close-characters-ii',
    'related_session' => 'merge-close-characters-ii',
];
