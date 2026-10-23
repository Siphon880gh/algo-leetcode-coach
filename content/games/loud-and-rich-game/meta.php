<?php
declare(strict_types=1);

return [
    'title' => 'Loud and Rich',
    'leetcode' => 851,
    'difficulty' => 'Med',
    'summary' => 'Edge richer → poorer. For each person, DFS (memoized) over people richer than them: answer[x] is the quietest among x and everyone reachable upward.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'loud-and-rich',
    'related_session' => 'loud-and-rich',
];
