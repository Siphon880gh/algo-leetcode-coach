<?php
declare(strict_types=1);

return [
    'title' => 'Find Expensive Cities: city average above the overall average',
    'leetcode' => 2987,
    'difficulty' => 'Easy',
    'summary' => 'GROUP BY city with HAVING AVG(price) > (SELECT AVG(price) over the whole table). The overall average is over listings, not over the city averages.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-expensive-cities',
];
