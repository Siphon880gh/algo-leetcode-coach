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
            'message' => "Read the problem statement above.\nLook up preference positions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Precompute rank[x][y]', 'next' => 's2'],
                ['label' => 'Search the list each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That adds a factor of n per check.\nStep back to when you searched lists.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which u to test for x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Everyone', 'next' => 'wrong_b'],
                ['label' => 'Those ranked above partner[x] by x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only friends x prefers over its partner matter.\nStep back to when you tested everyone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count x twice if several u work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count x once', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer counts friends, not pairs.\nStep back to when you double counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Example 1 → 2. Example 2 → 0. Example 3 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
