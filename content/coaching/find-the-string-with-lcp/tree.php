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
            'message' => "Read the problem statement above.\nLetter for a new class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The next unused letter', 'next' => 's2'],
                ['label' => 'Always a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Positions with lcp 0 must differ; Example 1 → empty instead of abab.\nStep back to when you reused a.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The string is built. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it', 'next' => 'wrong_b'],
                ['label' => 'Rebuild its lcp and compare', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The matrix may be inconsistent; Example 3 → aaaa instead of empty.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → abab, aaaa, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
