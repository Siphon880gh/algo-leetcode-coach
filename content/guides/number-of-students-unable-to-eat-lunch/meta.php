<?php
declare(strict_types=1);

return [
    'title' => 'Number of Students Unable to Eat Lunch: count preferences',
    'leetcode' => 1700,
    'difficulty' => 'Easy',
    'summary' => 'Order of students does not matter, since they rotate. Walk the sandwich stack: if nobody wants the top sandwich, everyone left is stuck; otherwise decrement that preference.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['simulation', 'counting', 'queue', 'leetcode'],
    'related_session' => 'number-of-students-unable-to-eat-lunch',
];
