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
            'message' => "Read the problem statement above.\na = 5. How many set bits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2, since 5 = 101', 'next' => 's2'],
                ['label' => '3, the number of binary digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 5 is 101: three digits, but only two of them are 1.\nStep back to when you counted digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s1 = 2, s2 = 4. Score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · 4 = 8', 'next' => 'wrong_b'],
                ['label' => '4 / 2 = 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The product is only for s1 ≥ s2. Always multiplying gives 8 instead of 2.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples give 6, 2 and 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
