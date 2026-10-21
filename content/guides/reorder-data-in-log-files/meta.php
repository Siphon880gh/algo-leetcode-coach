<?php
declare(strict_types=1);

return [
    'title' => 'Reorder Data in Log Files: sort letter logs by content, keep digit logs in order',
    'leetcode' => 937,
    'difficulty' => 'Med',
    'summary' => 'Split each log into identifier and content. Letter logs sort by (content, identifier); digit logs keep their original order and go after all letter logs. A stable sort with a two-way key does it.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'strings', 'leetcode'],
    'related_session' => 'reorder-data-in-log-files',
];
