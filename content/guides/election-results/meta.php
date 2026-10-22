<?php
declare(strict_types=1);

return [
    'title' => 'Election Results: split each vote, then keep the top',
    'leetcode' => 2820,
    'difficulty' => 'Med',
    'summary' => 'Weight each row by 1 / (number of rows for that voter), sum the weights per candidate, and keep the candidates equal to the maximum.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'leetcode'],
    'related_session' => 'election-results',
];
