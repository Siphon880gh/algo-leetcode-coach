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
            'message' => "Read the problem statement above.\nPair the window with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'best[l], segments before it', 'next' => 's2'],
                ['label' => 'best[r + 1], which can overlap it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Overlap counts prizes twice; Example 1 → 12 instead of 7.\nStep back to when you used best[r + 1].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shrink while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[r] − p[l] ≥ k', 'next' => 'wrong_b'],
                ['label' => 'p[r] − p[l] > k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A width of exactly k is allowed; Example 1 → 6 instead of 7.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 7, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
