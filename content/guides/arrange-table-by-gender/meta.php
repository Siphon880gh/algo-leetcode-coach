<?php
declare(strict_types=1);

return [
    'title' => 'Arrange Table by Gender: rank within gender, then interleave',
    'leetcode' => 2308,
    'difficulty' => 'Med',
    'summary' => 'Number each user within their gender by ascending user_id with ROW_NUMBER, then order by that number and, within it, by a fixed gender rank: female, other, male.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'arrange-table-by-gender',
];
