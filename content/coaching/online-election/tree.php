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
            'message' => "Read the problem statement above.\nRecount the votes for every query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute the leader after each vote', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n) per query.\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update the leader when count[p] is how large?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count[p] > count[leader]', 'next' => 'wrong_b'],
                ['label' => 'count[p] ≥ count[leader]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties go to the most recent vote.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Query at time t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search the last vote time ≤ t', 'next' => 'success'],
                ['label' => 'Find the first vote time ≥ t', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A vote after t has not happened yet.\nStep back to when you looked ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) build, O(log n) per query. persons = [0,1,1,0,0,1,0], times = [0,5,10,15,20,25,30]: q(3) → 0, q(12) → 1, q(25) → 1, q(15) → 0, q(24) → 0, q(8) → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
