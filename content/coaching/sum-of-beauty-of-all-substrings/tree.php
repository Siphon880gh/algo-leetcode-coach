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
            'message' => "Read the problem statement above.\nMinimum over which counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-zero counts only', 'next' => 's2'],
                ['label' => 'All 26', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Absent letters would make the minimum always 0.\nStep back to when you included zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Recount each substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, extend incrementally', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Recounting adds another factor of n.\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(26 · n²), fine for n ≤ 500', 'next' => 'success'],
                ['label' => 'Too slow, need something cleverer', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is about 6.5 · 10^6 operations.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n²). Examples → 5, 17.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
