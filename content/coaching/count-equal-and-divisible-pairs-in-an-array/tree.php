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
            'message' => "Read the problem statement above.\nWhich pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i < j, once each', 'next' => 's2'],
                ['label' => 'All ordered (i, j)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 8, not 4.\nStep back to when you counted both orders.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What must k divide?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] · nums[j]', 'next' => 'wrong_b'],
                ['label' => 'i · j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 counts (0, 6) because 0 · 6 = 0, though 3 · 3 = 9 is odd.\nStep back to when you multiplied values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pairs with index 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always divisible', 'next' => 'success'],
                ['label' => 'Skip them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 3 without (0, 6).\nStep back to when you skipped index 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
