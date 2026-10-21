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
            'message' => "Read the problem statement above.\nWhich balloon stays in a run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one with the largest time', 'next' => 's2'],
                ['label' => 'The first one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Removing the costly one wastes time.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort each run', 'next' => 'wrong_b'],
                ['label' => 'Add min(current max, t[i]), then update max', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A running max does it in O(1) per balloon.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "New colour?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset max to 0', 'next' => 'success'],
                ['label' => 'Keep the old max', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Runs are independent.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abaac\" → 3. \"abc\" → 0. \"aabaa\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
