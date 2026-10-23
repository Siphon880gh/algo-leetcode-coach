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
            'message' => "Read the problem statement above.\nFree choices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only copy[0]', 'next' => 's2'],
                ['label' => 'Every index separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Multiplying the range sizes: example 1 → 16 instead of 2.\nStep back to when you treated indices as independent.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range for copy[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The bounds as given', 'next' => 'wrong_b'],
                ['label' => 'Each bound shifted by original[i] − original[0]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 0 instead of 2.\nStep back to when you skipped the shift.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
