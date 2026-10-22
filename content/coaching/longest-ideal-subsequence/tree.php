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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp per last letter, 26 values', 'next' => 's2'],
                ['label' => 'dp per index, checking every earlier index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Length 10^5 gives about 5 · 10^9 pairs.\nStep back to when you compared every pair of indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letters within k of c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wrap around, so z is next to a', 'next' => 'wrong_b'],
                ['label' => 'c − k … c + k, clipped to a … z', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The alphabet is not cyclic; s = az, k = 1 → 2 instead of 1.\nStep back to when you wrapped around.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Does the window include c itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'success'],
                ['label' => 'No, only other letters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. s = aa, k = 0 → 1 instead of 2.\nStep back to when you left out c.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n). Examples → 4, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
