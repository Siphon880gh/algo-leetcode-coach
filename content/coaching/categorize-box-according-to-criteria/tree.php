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
            'message' => "Read the problem statement above.\nBulky when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Either test holds', 'next' => 's2'],
                ['label' => 'Both tests hold', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One test is enough; 10000 × 1 × 1 with mass 1 → Neither instead of Bulky.\nStep back to when you required both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heavy when mass is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '> 100', 'next' => 'wrong_b'],
                ['label' => '≥ 100', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Exactly 100 counts; 1 × 1 × 1 with mass 100 → Neither instead of Heavy.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → Heavy, Neither.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
