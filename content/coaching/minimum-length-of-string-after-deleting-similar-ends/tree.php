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
            'message' => "Read the problem statement above.\nRemove one char from each end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove the whole run on each side', 'next' => 's2'],
                ['label' => 'One at a time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Single letters turn 'aaba' into 'ab' instead of 'b'.\nStep back to when you removed single chars.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Outer loop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i ≤ j', 'next' => 'wrong_b'],
                ['label' => 'i < j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A lone middle character cannot be both prefix and suffix.\nStep back to when you allowed i = j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Inner skip bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i ≤ j and j ≥ i', 'next' => 'success'],
                ['label' => 'Stop at i < j', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A run like aaa should vanish completely.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
