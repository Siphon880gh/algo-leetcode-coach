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
            'message' => "Read the problem statement above.\nCheck pairs directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: group by gcd(x, k)', 'next' => 's2'],
                ['label' => 'Yes, test every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n reaches 10^5, so about 5 · 10^9 pairs.\nStep back to when you tested every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why gcd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Group by x mod k instead', 'next' => 'wrong_b'],
                ['label' => 'k | xy exactly when k | gcd(x,k) · gcd(y,k)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Residues decide divisibility too, but there can be up to 10^5 of them, so pairing residue classes is up to 10^10 checks; k has at most 128 gcd classes.\nStep back to when you used remainders.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pairs within one class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c(c − 1) / 2', 'next' => 'success'],
                ['label' => 'c²', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That counts each element with itself and both orders; Example 1 → 10, not 7.\nStep back to when you squared.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log k + d²). Examples → 7, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
