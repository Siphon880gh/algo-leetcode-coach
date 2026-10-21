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
            'message' => "Read the problem statement above.\nWhich numbers go into the gcd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the smallest and the largest', 'next' => 's2'],
                ['label' => 'Every element of the array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The task asks for gcd(min, max); for [2,5,6,9,10] the whole-array gcd is 1 but the answer is 2.\nStep back to when you used every element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Euclid step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gcd(a, b) = gcd(b, a − 1)', 'next' => 'wrong_b'],
                ['label' => 'gcd(a, b) = gcd(b, a mod b)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only a mod b (or a − b) keeps the divisors the same.\nStep back to when you subtracted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b becomes 0; answer is a', 'next' => 'success'],
                ['label' => 'a equals b', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With the mod form, a and b may never be equal; stop at b = 0.\nStep back to when you waited for a = b.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
