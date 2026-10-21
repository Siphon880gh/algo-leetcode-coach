<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Hours of Training to Win a Competition: energy total, experience gaps',
    'leetcode' => 2383,
    'difficulty' => 'Easy',
    'summary' => 'Energy only decreases, so it must exceed the total of all opponents’ energy: train max(0, Σ energy + 1 − initialEnergy). Experience grows, so simulate and top it up whenever it is not strictly above the next opponent’s.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'leetcode'],
    'related_session' => 'minimum-hours-of-training-to-win-a-competition',
];
