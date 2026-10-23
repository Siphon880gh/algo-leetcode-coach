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
            'message' => "Read the problem statement above.\nSubtract parallelograms?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, they are counted twice', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The unit square → 2 instead of 1.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair two segments on the same line?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, any same-slope pair', 'next' => 'wrong_b'],
                ['label' => 'No, only different lines', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Points (0, 0), (1, 0), (2, 0), (0, 1), (1, 1) → 6 instead of 3.\nStep back to when you paired collinear segments.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log C). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
