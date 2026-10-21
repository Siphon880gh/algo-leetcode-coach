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
            'message' => "Read the problem statement above.\nSegments allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to k + 1', 'next' => 's2'],
                ['label' => 'Up to k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The initial size is free.\nStep back to when you used k segments.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Size within a segment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its average', 'next' => 'wrong_b'],
                ['label' => 'Its maximum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The size must hold every value.\nStep back to when you used the average.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min over all segment counts ≤ k + 1', 'next' => 'success'],
                ['label' => 'Exactly k + 1 segments', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Fewer resizes are allowed.\nStep back to when you forced k + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · k). Examples → 10, 10, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
