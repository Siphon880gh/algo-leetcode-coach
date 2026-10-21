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
            'message' => "Read the problem statement above.\nFind the time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search: trips grow with time', 'next' => 's2'],
                ['label' => 'Simulate one time unit at a time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The answer can reach 10^14 time units.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Upper bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'totalTrips', 'next' => 'wrong_b'],
                ['label' => 'min(time) · totalTrips', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 needs time 2 for one trip on a bus of time 2.\nStep back to when you capped at totalTrips.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Summing trips at a large T?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop as soon as totalTrips is reached', 'next' => 'success'],
                ['label' => 'Always sum every bus', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With T near 10^14 and 10^5 buses of time 1, the sum reaches 10^19, beyond 64-bit.\nStep back to when you summed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(min(time) · totalTrips)). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
