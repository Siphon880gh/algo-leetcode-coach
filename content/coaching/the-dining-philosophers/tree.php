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
            'message' => "Read the problem statement above.\nEveryone grabs the left fork first, no other rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: that can deadlock', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All five can hold one fork and wait forever.\nStep back to when you used no rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sleep and retry', 'next' => 'wrong_b'],
                ['label' => 'At most four at the table, or a fixed fork order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Retrying with sleeps can still livelock.\nStep back to when you chose to sleep.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One global lock?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Correct but only one eats at a time', 'next' => 'success'],
                ['label' => 'Best option', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It removes all parallel eating.\nStep back to when you chose a global lock.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call plus waiting. No deadlock with four seats.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
