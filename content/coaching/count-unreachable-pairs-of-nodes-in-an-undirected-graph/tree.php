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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Component sizes', 'next' => 's2'],
                ['label' => 'BFS from every node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 10^5 searches over the whole graph is at least 10^10 steps.\nStep back to when you searched from every node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs from the sizes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ s · (n − s)', 'next' => 'wrong_b'],
                ['label' => 's · seen, then seen += s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every pair is counted from both sides; Example 2 → 28 instead of 14.\nStep back to when you used s · (n − s).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n = 10^5 with no edges gives 4,999,950,000, past 2^31.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + E · α(n)). Examples → 0, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
