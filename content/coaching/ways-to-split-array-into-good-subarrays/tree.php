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
            'message' => "Read the problem statement above.\nNo 1 at all?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Return the empty product 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. No subarray can contain exactly one 1; [0, 0] → 1 instead of 0.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the gaps how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add them', 'next' => 'wrong_b'],
                ['label' => 'Multiply them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The cuts are independent choices; [1, 0, 0, 1, 0, 1] → 5 instead of 6.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
