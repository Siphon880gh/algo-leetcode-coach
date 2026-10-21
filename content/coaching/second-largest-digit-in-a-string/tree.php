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
            'message' => "Read the problem statement above.\nEqual to the largest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 's2'],
                ['label' => 'Treat it as second', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. abc1111 has no second distinct digit.\nStep back to when you accepted equals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Discard the old maximum', 'next' => 'wrong_b'],
                ['label' => 'Old maximum becomes second', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It is now the second largest.\nStep back to when you discarded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip', 'next' => 'success'],
                ['label' => 'Map to digits', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only digit characters count.\nStep back to when you mapped letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
