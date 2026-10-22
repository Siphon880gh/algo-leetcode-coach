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
            'message' => "Read the problem statement above.\nReplace −1 with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its column’s maximum', 'next' => 's2'],
                ['label' => 'Its row’s maximum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [[1, 2, 2], [4, 6, 6], [7, 8, 9]].\nStep back to when you used the row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which cells change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every cell below its column maximum', 'next' => 'wrong_b'],
                ['label' => 'Only −1 cells', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [[5, 2], [5, 2]] instead of [[3, 2], [5, 2]].\nStep back to when you raised every cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → [[1, 2, 9], [4, 8, 6], [7, 8, 9]], [[3, 2], [5, 2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
