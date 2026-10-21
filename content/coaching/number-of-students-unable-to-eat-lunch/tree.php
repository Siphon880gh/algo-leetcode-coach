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
            'message' => "Read the problem statement above.\nTrack queue order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: students rotate freely', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any student can eventually reach the front.\nStep back to when you tracked order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Nobody wants the top sandwich?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip that sandwich', 'next' => 'wrong_b'],
                ['label' => 'Return the remaining count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The stack cannot be reordered.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All sandwiches taken?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Everyone ate.\nStep back to when you returned n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
