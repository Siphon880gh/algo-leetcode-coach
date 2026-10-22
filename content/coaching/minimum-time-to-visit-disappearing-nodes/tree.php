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
            'message' => "Read the problem statement above.\nWhen is a node too late?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Arrival time ≥ disappear', 'next' => 's2'],
                ['label' => 'Arrival time > disappear', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Arriving exactly when it disappears is too late: example 3 → [0, 1] instead of [0, −1].\nStep back to when you allowed arrival at the disappear time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does the check go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After plain Dijkstra, on the final distances', 'next' => 'wrong_b'],
                ['label' => 'Inside Dijkstra, before relaxing from the node', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Paths through vanished nodes still count: example 1 → [0, −1, 3] instead of [0, −1, 4].\nStep back to when you filtered afterwards.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log n). Examples → [0, −1, 4], [0, 2, 3], [0, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
