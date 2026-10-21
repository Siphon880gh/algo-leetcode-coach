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
            'message' => "Read the problem statement above.\nAdd seats to every flight in each range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: two updates per booking', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(bookings · n).\nStep back to when you updated every flight.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Booking [first, last, seats]. Updates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'diff[first] += seats; diff[last] −= seats', 'next' => 'wrong_b'],
                ['label' => 'diff[first − 1] += seats; diff[last] −= seats', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flights are 1-indexed, the array is 0-indexed.\nStep back to when you skipped the shift.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix-sum the first n entries', 'next' => 'success'],
                ['label' => 'Return diff', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. diff holds changes, not totals.\nStep back to when you returned diff.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + bookings). [[1,2,10],[2,3,20],[2,5,25]], n = 5 → [10,55,45,25,25]. [[1,2,10],[2,2,15]], n = 2 → [10,25].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
