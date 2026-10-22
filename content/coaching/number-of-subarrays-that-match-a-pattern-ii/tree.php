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
            'message' => "Read the problem statement above.\nn up to 10^6: check every start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, KMP or Z', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. At m = n / 2 that is about 2.5 · 10^11 comparisons.\nStep back to when you checked each start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a full match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j = 0', 'next' => 'wrong_b'],
                ['label' => 'j = f[m − 1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Overlapping matches are lost; example 1 → 2 instead of 4.\nStep back to when you reset to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
