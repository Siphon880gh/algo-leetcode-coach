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
            'message' => "Read the problem statement above.\nStart with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 's2'],
                ['label' => 'nums[0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Rotations tie, so 0 first is smallest: example 1 → [1, 2, 0] instead of [0, 1, 2].\nStep back to when you started at nums[0].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest unused one', 'next' => 'wrong_b'],
                ['label' => 'Smallest one that keeps the optimum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That ignores cost: example 2 → [0, 1, 2], score 4, instead of [0, 2, 1].\nStep back to when you ignored the DP.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² 2^n). Examples → [0, 1, 2], [0, 2, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
