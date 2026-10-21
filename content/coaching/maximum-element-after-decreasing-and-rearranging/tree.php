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
            'message' => "Read the problem statement above.\nFirst element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must become 1', 'next' => 's2'],
                ['label' => 'Keep its value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first element must be 1.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cur + 1', 'next' => 'wrong_b'],
                ['label' => 'min(cur + 1, x)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values can only decrease, never grow.\nStep back to when you ignored x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of processing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending', 'next' => 'success'],
                ['label' => 'Original order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rearranging is allowed and sorted order is best.\nStep back to when you kept the original order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 3, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
