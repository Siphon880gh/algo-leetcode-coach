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
            'message' => "Read the problem statement above.\nn reaches 5 · 10^5. Count every special substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use run lengths', 'next' => 's2'],
                ['label' => 'Yes, as in part I', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A string of one letter has about 1.25 · 10^11 of them.\nStep back to when you counted them all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Candidates from L1 ≥ L2 ≥ L3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L1 − 2 only', 'next' => 'wrong_b'],
                ['label' => 'L1 − 2, min(L1 − 1, L2), L3', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Copies can come from two runs; aaabaaa → 1 instead of 2.\nStep back to when you used L1 − 2 only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, −1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
