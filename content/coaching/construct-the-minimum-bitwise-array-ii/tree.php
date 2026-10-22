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
            'message' => "Read the problem statement above.\nFind a how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clear the top bit of the trailing ones', 'next' => 's2'],
                ['label' => 'Try every a < x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Up to 100 · 10^9 checks.\nStep back to when you tried every a.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "x = 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '−1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 OR 2 = 3, not 2: example 1 → [1, 1, 4, 3] instead of [−1, 1, 4, 3].\nStep back to when you answered 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log x). Examples → [−1, 1, 4, 3], [9, 12, 15].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
