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
            'message' => "Read the problem statement above.\nOrder to try numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Numeric order', 'next' => 's2'],
                ['label' => 'String order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [12, 3, 45] instead of [3, 12, 45].\nStep back to when you compared them as strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "ok(0, 0) is false?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the sorted array', 'next' => 'wrong_b'],
                ['label' => 'Return []', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [1, 2, 3] instead of [].\nStep back to when you returned something anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · k · n). Examples → [3, 12, 45], [5, 10], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
