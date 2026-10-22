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
            'message' => "Read the problem statement above.\nn reaches 10^5. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Running extremes as j moves', 'next' => 's2'],
                ['label' => 'Test every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 10^10 checks.\nStep back to when you tested every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Track?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the min', 'next' => 'wrong_b'],
                ['label' => 'Both min and max', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums[j] may be the smaller one; example 1 → [−1, −1] instead of [0, 3].\nStep back to when you tracked only the min.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [0, 3], [0, 0], [−1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
