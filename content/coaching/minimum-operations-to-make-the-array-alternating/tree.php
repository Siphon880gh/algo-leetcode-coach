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
            'message' => "Read the problem statement above.\nWhat to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values at even and odd indices separately', 'next' => 's2'],
                ['label' => 'Values over the whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The two parities must hold different values, so they need separate counts.\nStep back to when you counted together.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both tops are the same value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep both tops anyway', 'next' => 'wrong_b'],
                ['label' => 'Use the second best on one side', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 1, but [2,2,2,2,2] is not alternating; the answer is 2.\nStep back to when you kept the clash.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No second value on a side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat it as count 0', 'next' => 'success'],
                ['label' => 'Give up on that option', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any new positive integer works; [1,1,1] → 1 by changing the middle.\nStep back to when you dropped the option.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
