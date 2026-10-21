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
            'message' => "Read the problem statement above.\nSimulate with a heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Possible, but O(1) math suffices', 'next' => 's2'],
                ['label' => 'Required', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values up to 10^5 make the formula simpler.\nStep back to when you required simulation.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "If c ≥ a + b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(a + b + c) // 2', 'next' => 'wrong_b'],
                ['label' => 'a + b', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The big pile cannot all be paired.\nStep back to when you halved the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(a + b + c) // 2', 'next' => 'success'],
                ['label' => 'c', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Small piles can also pair with each other.\nStep back to when you used c.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 6, 7, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
