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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR the two numbers; differing bits become 1', 'next' => 's2'],
                ['label' => 'Compare the decimal digits of x and y', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Decimal digits are not bits. 1 and 4 differ in one decimal digit but in two bits.\nStep back to when you compared decimal digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "z = x ^ y.\nHow do you count its 1 bits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return z & 1', 'next' => 'wrong_b'],
                ['label' => 'Repeat z &= z − 1 and count, or use a popcount', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. z & 1 tests only the lowest bit. You need every set bit.\nStep back to when you checked one bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each z &= z − 1 drops the lowest set bit, so the loop runs once per differing bit. O(1) time. Total Hamming Distance (477) sums this over all pairs with per-bit counts.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR, then popcount. Not 477', 'next' => 'success'],
                ['label' => 'popcount(x + y)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. z is already the difference mask. Adding x and y mixes in carries and has nothing to do with differing bits.\nStep back to when you added the numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. XOR marks the differing bits; count them. x = 1, y = 4 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
