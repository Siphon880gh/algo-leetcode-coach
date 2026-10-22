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
            'message' => "Read the problem statement above.\nEach new digit is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2d mod 10, plus 1 if the next digit ≥ 5', 'next' => 's2'],
                ['label' => '2d mod 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Carries vanish; example 1 → [2, 6, 8] instead of [3, 7, 8].\nStep back to when you dropped the carry.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The head is at least 5?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the head', 'next' => 'wrong_b'],
                ['label' => 'Add a new leading digit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The number grows a digit; example 2 → [9, 9, 8] instead of [1, 9, 9, 8].\nStep back to when you skipped the new head.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [3, 7, 8], [1, 9, 9, 8].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
