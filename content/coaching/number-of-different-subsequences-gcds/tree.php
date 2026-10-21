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
            'message' => "Read the problem statement above.\nEnumerate subsequences?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, enumerate candidate gcds', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2^(10^5) subsequences is impossible.\nStep back to when you enumerated them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which elements for candidate g?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only g itself', 'next' => 'wrong_b'],
                ['label' => 'All present multiples of g', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. g may be the gcd of several larger multiples, like 2 from 6 and 10.\nStep back to when you required g present.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Harmonic: about M log M steps', 'next' => 'success'],
                ['label' => 'O(M²)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Multiples of g number M / g.\nStep back to when you said M².",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(M log² M). Examples → 5, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
