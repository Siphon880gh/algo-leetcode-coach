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
            'message' => "Read the problem statement above.\nGap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|goal − sum(nums)|', 'next' => 's2'],
                ['label' => 'goal − sum(nums)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The gap may be negative; we can add negative values too.\nStep back to when you dropped the absolute value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rounding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Floor', 'next' => 'wrong_b'],
                ['label' => 'Ceiling', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A leftover piece still needs one element.\nStep back to when you floored.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sums reach about 10^11 in absolute value.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
