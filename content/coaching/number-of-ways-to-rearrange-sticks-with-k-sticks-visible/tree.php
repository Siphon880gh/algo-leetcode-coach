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
            'message' => "Read the problem statement above.\nConsider the shortest stick: whom can it block?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nobody', 'next' => 's2'],
                ['label' => 'The sticks after it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every other stick is taller, so it hides no one.\nStep back to when you let it block later sticks.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shortest stick first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hidden', 'next' => 'wrong_b'],
                ['label' => 'Visible: dp[i − 1][j − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Nothing is to its left.\nStep back to when you hid it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shortest stick elsewhere?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(i − 1) · dp[i − 1][j]', 'next' => 'success'],
                ['label' => 'dp[i − 1][j]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. There are i − 1 positions to choose from.\nStep back to when you counted one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Examples → 3, 1, 647427950.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
