<?php
declare(strict_types=1);

return [
    'title' => 'Champagne Tower: pour everything, pass half the excess down',
    'leetcode' => 799,
    'difficulty' => 'Med',
    'summary' => 'Pour all the champagne into the top glass and process row by row. Any glass holding more than 1 cup sends (amount − 1) / 2 to each of the two glasses below. The answer is min(1, the amount at the queried glass).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'simulation', 'leetcode'],
    'related_session' => 'champagne-tower',
];
