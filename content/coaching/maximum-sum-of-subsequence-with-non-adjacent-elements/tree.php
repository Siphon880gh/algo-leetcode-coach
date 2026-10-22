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
            'message' => "Read the problem statement above.\nAfter each update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Segment tree of end states', 'next' => 's2'],
                ['label' => 'Rerun the O(n) DP', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 2.5 · 10^9 steps at 5 · 10^4 each.\nStep back to when you reran the DP.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merging two halves forbids?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'Taking the left’s last and the right’s first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Neighbours across the split get taken: [1, 2, 3] → 6 instead of 4.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → 21, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
