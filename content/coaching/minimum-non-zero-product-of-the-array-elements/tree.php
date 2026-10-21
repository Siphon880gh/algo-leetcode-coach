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
            'message' => "Read the problem statement above.\nTarget values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As many 1s and (mx − 1)s as possible', 'next' => 's2'],
                ['label' => 'All values equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal values maximise a product with fixed sum.\nStep back to when you equalised.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Exponent reduction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reduce it mod 1e9+7', 'next' => 'wrong_b'],
                ['label' => 'Keep the exponent exact', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Exponents reduce mod p − 1 at most, not mod p.\nStep back to when you reduced it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Base before pow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reduce mx − 1 mod p', 'next' => 'success'],
                ['label' => 'Use it unreduced in fixed width', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 2^60 products overflow 64 bits.\nStep back to when you skipped the reduction.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(p). Examples → 1, 6, 1512.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
