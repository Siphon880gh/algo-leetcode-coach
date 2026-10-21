<?php
declare(strict_types=1);

return [
    'title' => 'Market Analysis II: rank each seller\'s sales',
    'leetcode' => 1159,
    'difficulty' => 'Hard',
    'summary' => 'Number each seller\'s sales by date with ROW_NUMBER, keep the second one, join its item brand, and left join that onto every user so sellers without a second sale still appear with no.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'leetcode'],
    'related_session' => 'market-analysis-ii',
];
