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
            'message' => "Read the problem statement above.\nCorners?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All four must be points', 'next' => 's2'],
                ['label' => 'Two opposite corners are enough', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, 1], [3, 3]] → 4 instead of −1.\nStep back to when you used two corners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Other points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None strictly inside', 'next' => 'wrong_b'],
                ['label' => 'None inside or on the border', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 4 instead of 2.\nStep back to when you allowed the border.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). Examples → 4, −1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
