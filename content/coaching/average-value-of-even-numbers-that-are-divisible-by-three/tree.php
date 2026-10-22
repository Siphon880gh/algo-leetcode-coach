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
            'message' => "Read the problem statement above.\nKeep x when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x mod 6 = 0', 'next' => 's2'],
                ['label' => 'x mod 3 = 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x must also be even; [3,6] → 4 instead of 6.\nStep back to when you dropped the even test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No value qualifies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divide the sum by the count anyway', 'next' => 'wrong_b'],
                ['label' => 'Return 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 divides by zero.\nStep back to when you divided without the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 9, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
