<?php
declare(strict_types=1);

return [
    'title' => 'Date Range Generator: step in UTC days',
    'leetcode' => 2777,
    'difficulty' => 'Med',
    'summary' => 'Parse both dates, then loop while the current date is not past the end: yield it formatted, and add step days with setUTCDate so month ends and time zones cannot shift it.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'date-range-generator',
];
