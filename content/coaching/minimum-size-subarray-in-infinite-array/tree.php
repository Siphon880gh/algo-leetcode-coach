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
            'message' => "Read the problem statement above.\ntarget reaches 10^9. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count full copies, then window for the remainder', 'next' => 's2'],
                ['label' => 'Slide over repeated copies until the sum reaches target', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With all values 1, the window spans 10^9 elements.\nStep back to when you repeated the array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums alone', 'next' => 'wrong_b'],
                ['label' => 'nums + nums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The remainder can wrap; [1, 1, 2, 4] with target 13 → −1 instead of 6.\nStep back to when you used one copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
