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
            'message' => "Read the problem statement above.\nMay the path revisit nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, and must return to 0', 'next' => 's2'],
                ['label' => 'No, simple paths only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 → 75 uses 0 → 1 → 0 → 3 → 0.\nStep back to when you banned revisits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A node visited twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add it on every visit', 'next' => 'wrong_b'],
                ['label' => 'Add its value once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Quality sums distinct nodes; track visit counts.\nStep back to when you added it again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you record a candidate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whenever the walk is back at 0', 'next' => 'success'],
                ['label' => 'At every node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A valid path must end at node 0.\nStep back to when you recorded elsewhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. At most 10 edges per walk. Examples → 75, 25, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
