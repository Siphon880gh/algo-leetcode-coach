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
            'message' => "Read the problem statement above.\nZero digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip them', 'next' => 's2'],
                ['label' => 'Keep them as 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [100, 0, 2], and 0 is not a component.\nStep back to when you kept zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the rightmost digit', 'next' => 'wrong_b'],
                ['label' => 'From the leftmost digit, so descending', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [7, 30, 500] instead of [500, 30, 7].\nStep back to when you started on the right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → [500, 30, 7], [100, 2], [6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
