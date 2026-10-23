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
            'message' => "Read the problem statement above.\nDistance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(d, n − d)', 'next' => 's2'],
                ['label' => '|i − q|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2, −1, 4] instead of [2, −1, 3].\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the next', 'next' => 'wrong_b'],
                ['label' => 'Previous and next in the list', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [1, 1, 1, 2], query 2 → 2 instead of 1.\nStep back to when you skipped the previous one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q log n). Examples → [2, −1, 3], [−1, −1, −1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
