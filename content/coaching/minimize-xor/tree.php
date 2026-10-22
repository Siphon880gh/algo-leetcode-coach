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
            'message' => "Read the problem statement above.\nHow many set bits must x have?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'popcount(num2)', 'next' => 's2'],
                ['label' => 'popcount(num1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The bit count comes from num2; Example 2 → 1 instead of 3.\nStep back to when you counted num1’s bits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Spend the bits on num1’s set bits starting from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The lowest', 'next' => 'wrong_b'],
                ['label' => 'The highest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A high bit left out costs the most; num1 = 6, num2 = 1 → 2 instead of 4.\nStep back to when you started from the low end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leftover bits go to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num1’s zero positions, lowest first', 'next' => 'success'],
                ['label' => 'num1’s zero positions, highest first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A high extra bit adds a large term; Example 2 → 2^30 + 1 instead of 3.\nStep back to when you filled from the top.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(31). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
