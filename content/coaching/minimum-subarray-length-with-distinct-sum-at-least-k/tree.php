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
            'message' => "Read the problem statement above.\nAdd x to the sum when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When its count becomes 1', 'next' => 's2'],
                ['label' => 'Every time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [3, 3], k = 6 → 2 instead of −1.\nStep back to when you added repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subtract nums[l] when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every time it leaves', 'next' => 'wrong_b'],
                ['label' => 'When its count drops to 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 2.\nStep back to when you subtracted repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
