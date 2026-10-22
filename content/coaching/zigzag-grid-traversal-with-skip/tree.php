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
            'message' => "Read the problem statement above.\nOdd rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 's2'],
                ['label' => 'Left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1, 3] instead of [1, 4].\nStep back to when you kept the direction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Skip counter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart each row', 'next' => 'wrong_b'],
                ['label' => 'One for the whole walk', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [1, 3, 6, 4, 7, 9] instead of [1, 3, 5, 7, 9].\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → [1, 4], [2, 1, 2], [1, 3, 5, 7, 9].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
