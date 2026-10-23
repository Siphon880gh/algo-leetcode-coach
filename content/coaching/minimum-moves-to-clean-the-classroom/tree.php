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
            'message' => "Read the problem statement above.\nEnergy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Track it; refill on R', 'next' => 's2'],
                ['label' => 'Ignore it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 4 instead of −1.\nStep back to when you ignored energy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Revisit (cell, mask)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never', 'next' => 'wrong_b'],
                ['label' => 'When the energy is higher than before', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [\"LR\", \"S.\", \".L\"], energy = 3 → −1 instead of 4.\nStep back to when you visited each pair once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · 2^L · energy). Examples → 2, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
