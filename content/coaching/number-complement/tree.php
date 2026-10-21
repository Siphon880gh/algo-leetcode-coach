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
                ['label' => 'Build a mask of ones exactly as wide as num, then XOR', 'next' => 's2'],
                ['label' => 'Return ~num', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. ~num flips all 32 bits, including leading zeros, so ~5 is −6, not 2.\nStep back to when you used ~num.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "num = 5 has bit length 3.\nWhich mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0xFFFFFFFF', 'next' => 'wrong_b'],
                ['label' => '(1 << 3) − 1 = 111', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 32-bit all-ones mask flips the leading zeros too, giving a huge value.\nStep back to when you used a full-width mask.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Without a bit-length helper: mask = 0; while mask < num, mask = (mask << 1) | 1. Use 64 bits if L can be 31. Complement of Base 10 Integer (1009) also allows 0.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num XOR ((1 << bitLength) − 1). Not ~num', 'next' => 'success'],
                ['label' => 'Use 2^bitLength − num', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 2^L − num is off by one: 8 − 5 = 3, but the answer is 2. The mask is 2^L − 1.\nStep back to when you subtracted from 2^L.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. XOR with a mask of ones as wide as num. 5 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
