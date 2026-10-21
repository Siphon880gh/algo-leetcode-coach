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
            'message' => "Read the problem statement above.\nWhen is it impossible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When some letter appears more than (n + 1) // 2 times', 'next' => 's2'],
                ['label' => 'When some letter appears more than n / 2 times', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With odd n, a letter can take (n + 1) / 2 slots: \"aba\" works.\nStep back to when you used n / 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which letter goes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any letter', 'next' => 'wrong_b'],
                ['label' => 'The most frequent', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The most frequent letter needs the even slots without wrapping.\nStep back to when you picked any letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Even slots run out. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Continue at index 1, 3, 5, …', 'next' => 'success'],
                ['label' => 'Start over at index 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Index 0 is already filled; the odd slots come next.\nStep back to when you restarted at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"aab\" → \"aba\". \"aaab\" → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
