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
            'message' => "Read the problem statement above.\nCost of a subarray?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ (running max − element)', 'next' => 's2'],
                ['label' => 'Σ drops between neighbors', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 21 instead of 17.\nStep back to when you summed drops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Right end as l moves left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart from n − 1', 'next' => 'wrong_b'],
                ['label' => 'Only shrinks', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²), about 5 · 10^9 steps at n = 10^5.\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) amortized. Examples → 17, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
