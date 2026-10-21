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
            'message' => "Read the problem statement above.\nSort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Arrival time', 'next' => 's2'],
                ['label' => 'Distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A far but fast monster can arrive first.\nStep back to when you sorted by distance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Arrival time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'floor(dist / speed)', 'next' => 'wrong_b'],
                ['label' => 'ceil(dist / speed)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A monster at 2.5 minutes can still be shot at minute 2.\nStep back to when you used floor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Lose condition at shot i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arrival ≤ i', 'next' => 'success'],
                ['label' => 'arrival < i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Arriving exactly when the weapon charges is a loss.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
