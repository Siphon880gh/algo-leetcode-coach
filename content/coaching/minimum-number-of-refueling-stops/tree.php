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
            'message' => "Read the problem statement above.\nStop at every station you reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: decide later which stations you used', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That uses more stops than needed.\nStep back to when you stopped everywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You cannot reach the next position. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the most recent station', 'next' => 'wrong_b'],
                ['label' => 'Pop the largest station passed and count a stop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The largest one gives the most range per stop.\nStep back to when you took the most recent.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The heap is empty and you still cannot reach it. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return the stops so far', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You cannot reach the target.\nStep back to when you returned the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). target = 1, startFuel = 1, [] → 0. target = 100, startFuel = 1, [[10,100]] → −1. target = 100, startFuel = 10, [[10,60],[20,30],[30,30],[60,40]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
