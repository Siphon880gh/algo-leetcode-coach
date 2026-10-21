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
            'message' => "Read the problem statement above.\nFormula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n! / Π subtree sizes', 'next' => 's2'],
                ['label' => 'Product of children counts factorial', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That ignores interleaving between subtrees.\nStep back to when you multiplied child factorials.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Division mod p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Integer division after mod', 'next' => 'wrong_b'],
                ['label' => 'Modular inverses (p is prime)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Division does not survive the modulus.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Traversal on a 10^5 chain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Iterative', 'next' => 'success'],
                ['label' => 'Recursive', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Deep recursion overflows.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
