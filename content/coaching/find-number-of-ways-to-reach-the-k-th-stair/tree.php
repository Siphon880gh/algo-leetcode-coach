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
            'message' => "Read the problem statement above.\nWhich counts j of up moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every j with 0 ≤ 2^j − k ≤ j + 1', 'next' => 's2'],
                ['label' => 'Only the smallest j with 2^j ≥ k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Larger j also work: k = 1 → 1 instead of 4.\nStep back to when you kept one j.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ways to place d downs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(j, d)', 'next' => 'wrong_b'],
                ['label' => 'C(j + 1, d)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A down can also come before the first up: k = 1 → 2 instead of 4.\nStep back to when you used C(j, d).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
