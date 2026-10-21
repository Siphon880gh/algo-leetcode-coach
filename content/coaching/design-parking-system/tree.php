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
            'message' => "Read the problem statement above.\nData structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three counters', 'next' => 's2'],
                ['label' => 'List of parked cars', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only counts matter.\nStep back to when you stored cars.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No slot of that type left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use a bigger slot', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A car may park only in its own type.\nStep back to when you used another type.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost per call?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'success'],
                ['label' => 'O(slots)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One counter check and decrement.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. ParkingSystem(1, 1, 0) → true, true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
