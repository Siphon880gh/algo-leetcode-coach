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
            'message' => "Problem: You get a building with floors 0 … n − 1, the elevator's start floor, and requests [arrival, floor]. Each second the elevator moves one floor up, one floor down, or stays. A request is met once the elevator is on its floor at or after its arrival time. Return the earliest time when every request is met. It is Elevator Requests III with many more requests. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nOrder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Checked by the interval DP for a fixed T', 'next' => 's2'],
                ['label' => 'Arrival order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): start = 2, requests [[0, 6], [3, 0], [9, 4]] → 14 instead of 11.\nStep back to when you used arrival order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visit a floor before its request?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It counts', 'next' => 'wrong_b'],
                ['label' => 'It does not count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same check → 8 instead of 11.\nStep back to when you ignored arrivals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m² log T). Constructed checks → 11, 14, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
