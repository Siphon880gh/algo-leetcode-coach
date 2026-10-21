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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rewrite as a subset-sum count', 'next' => 's2'],
                ['label' => 'Try all 2^n sign combinations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2^n branches only survive because n ≤ 20, and they hide the structure. The subset-sum view is O(n × total).\nStep back to when you enumerated signs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Minus group sum = neg.\nWhat must neg be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'neg = target', 'next' => 'wrong_b'],
                ['label' => 'neg = (total − target) / 2, must be a non-negative integer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That only holds if the plus group's sum equals target with no minus.\nStep back to when you set neg = target.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "f[0] = 1; for each x, for j from neg down to x: f[j] += f[j − x]. Answer f[neg]. Zeros double the count automatically. O(n × neg).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'neg formula, parity check, 0-1 counting with j down. Not 416', 'next' => 'success'],
                ['label' => 'Loop j upward from x to neg', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Going up reuses x in the same pass, so it counts unbounded picks.\nStep back to when you looped j upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Turn signs into a subset count and run 0-1 knapsack counting. [1,1,1,1,1], 3 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
