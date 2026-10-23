<?php
declare(strict_types=1);

return [
    'title' => 'Elevator Requests IV: binary search the finish time, then sweep backwards',
    'leetcode' => 4029,
    'difficulty' => 'Hard',
    'summary' => 'Fix a finish time T and run time backwards. A request is met when the last visit to its floor is at or after its arrival, so backwards the first visit must come by T − arrival. Floors visited backwards always form an interval, so an interval DP checks T. Feasibility only gets easier as T grows.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'elevator-requests-iv',
];
