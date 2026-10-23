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
            'message' => "Read the problem statement above.\nResult shape?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Zeros then ones', 'next' => 's2'],
                ['label' => 'Keep the original order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [0, 1, 0, 1].\nStep back to when you skipped the sort.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of odd values', 'next' => 'wrong_b'],
                ['label' => 'The number of even values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [0, 0, 0, 1, 1] instead of [0, 0, 1, 1, 1].\nStep back to when you counted odds.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [0, 0, 1, 1], [0, 0, 1, 1, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
