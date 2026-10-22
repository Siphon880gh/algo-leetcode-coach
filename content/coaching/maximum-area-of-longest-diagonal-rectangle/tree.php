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
            'message' => "Read the problem statement above.\nCompare by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'l² + w², then area', 'next' => 's2'],
                ['label' => 'Area alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, 10], [7, 7]] → 49 instead of 10.\nStep back to when you compared areas.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Diagonal tie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First rectangle', 'next' => 'wrong_b'],
                ['label' => 'Larger area', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1, 7], [5, 5]] both have l² + w² = 50; → 7 instead of 25.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 48, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
