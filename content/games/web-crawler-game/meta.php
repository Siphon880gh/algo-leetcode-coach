<?php
declare(strict_types=1);

return [
    'title' => 'Web Crawler (BFS on links)',
    'leetcode' => 1236,
    'difficulty' => 'Med',
    'summary' => 'BFS from startUrl; for each page, follow its links whose hostname equals the start\'s hostname and that were not seen yet. Return everything visited.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'web-crawler',
    'related_session' => 'web-crawler',
];
