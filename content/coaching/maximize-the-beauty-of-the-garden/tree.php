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
            'message' => "Problem: Given an array of flower beauty values (possibly negative), remove any flowers so that at least two remain and the first and last remaining flowers have the same beauty. Return the maximum possible sum of the remaining values. For instance, [1,2,3,1,2] → 8 (keep 2,3,1,2), [100,1,1,-3,1] → 3, and [-1,-2,0,-1] → −2. (Restated from memory; limits and examples may differ slightly.)\nMiddle elements to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only positive ones', 'next' => 's2'],
                ['label' => 'All of them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Negatives in the middle can be removed.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which left end for value v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its previous occurrence', 'next' => 'wrong_b'],
                ['label' => 'Its first occurrence', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A farther left end only adds non-negative middle terms.\nStep back to when you took the previous one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Negative ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counted at full value', 'next' => 'success'],
                ['label' => 'Clamped to 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The two ends must remain, so their value counts.\nStep back to when you clamped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → 8, 3, −2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
