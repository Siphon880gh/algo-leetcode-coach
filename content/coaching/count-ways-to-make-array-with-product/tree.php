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
            'message' => "Read the problem statement above.\nWays to split exponent e over n slots?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(n − 1 + e, e)', 'next' => 's2'],
                ['label' => 'n^e', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Copies of the same prime are identical, so this is stars and bars.\nStep back to when you used n^e.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Primes interact?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use inclusion–exclusion', 'next' => 'wrong_b'],
                ['label' => 'No, multiply their counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each prime's exponents are distributed independently.\nStep back to when you used inclusion–exclusion.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Factorials needed up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'About n + 13 (exponents ≤ 13)', 'next' => 'success'],
                ['label' => 'k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The binomial top is n − 1 + e, and 2^14 > 10^4.\nStep back to when you sized by k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q · √k). Examples → [4,1,50734910], [1,2,3,10,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
