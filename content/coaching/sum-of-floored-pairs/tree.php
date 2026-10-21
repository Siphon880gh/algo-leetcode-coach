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
            'message' => "Read the problem statement above.\nAll pairs directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, n reaches 10^5', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 10^10 divisions.\nStep back to when you looped over pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop over divisors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every element separately', 'next' => 'wrong_b'],
                ['label' => 'Distinct values, times their count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Duplicates repeat the band walk.\nStep back to when you looped every element.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Band count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pre[min(M, (k + 1)y − 1)] − pre[ky − 1]', 'next' => 'success'],
                ['label' => 'cnt[ky] only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every value in the band has quotient k.\nStep back to when you counted one value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + M log M). Examples → 10, 49.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
