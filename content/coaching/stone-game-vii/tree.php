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
            'message' => "Read the problem statement above.\nScore for removing an end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of the remaining stones', 'next' => 's2'],
                ['label' => 'Value of the removed stone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You score what is left.\nStep back to when you scored the removed stone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "State value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both scores', 'next' => 'wrong_b'],
                ['label' => 'Score difference for the player to move', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The difference folds both into one number.\nStep back to when you stored both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fill order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i descending, j ascending', 'next' => 'success'],
                ['label' => 'Any order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. dp[i + 1][j] and dp[i][j − 1] must be ready.\nStep back to when you ignored order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 6, 122.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
