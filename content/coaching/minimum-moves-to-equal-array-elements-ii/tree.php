<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move everything to a median', 'next' => 's2'],
                ['label' => 'Move everything to the mean', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The mean minimizes squared distance, not total distance. [1,0,0,8,6]: mean 3 costs 16, median 1 costs 14.\nStep back to when you picked the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort: the target is nums[n / 2].\nWhy does a median work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the minimum, like 453', 'next' => 'wrong_b'],
                ['label' => 'Moving t past it adds cost on more values than it saves', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The minimum is 453's target, where a move changes n − 1 elements. Here one element moves, so the minimum is not optimal: [1,2,3] at 1 costs 3, at 2 costs 2.\nStep back to when you picked the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum |x − median| in 64 bits. Or pair the ends after sorting: Σ (nums[n − 1 − i] − nums[i]). O(n log n), or O(n) average with quickselect.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Median target, sum distances in 64 bits. Not 453', 'next' => 'success'],
                ['label' => 'For even n, average the two middle values first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With an even count, any value between the two middle elements is optimal. You do not need to average them, and averaging can leave a non-integer target.\nStep back to when you averaged the two middles.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Meet at the median and sum distances. [1,10,2,9] → 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
