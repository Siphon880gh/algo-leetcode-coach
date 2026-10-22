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
            'message' => "Read the problem statement above.\nSort order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decreasing', 'next' => 's2'],
                ['label' => 'Increasing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Negatives first sink every prefix; Example 1 → 0 instead of 6.\nStep back to when you sorted up.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count a prefix when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum ≥ 0', 'next' => 'wrong_b'],
                ['label' => 'sum > 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0 is not positive; Example 2 → 1 instead of 0.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
