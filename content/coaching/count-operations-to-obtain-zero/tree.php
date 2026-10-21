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
            'message' => "Read the problem statement above.\nWhich to subtract?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smaller from the larger', 'next' => 's2'],
                ['label' => 'Always num2 from num1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 2 − 3 goes negative; the rule picks the larger side.\nStep back to when you fixed the direction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When both are 0', 'next' => 'wrong_b'],
                ['label' => 'When either is 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 (10, 10) → 1 operation.\nStep back to when you waited for both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Batch with a mod?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add a / b operations', 'next' => 'success'],
                ['label' => 'Add 1 per mod step', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3: 2 mod 1 alone takes two subtractions.\nStep back to when you counted one per mod.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log max). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
