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
            'message' => "Read the problem statement above.\nWhich k to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Primes dividing some element, plus the smallest prime dividing none', 'next' => 's2'],
                ['label' => 'Only k = 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [3] → 1000000001 instead of 9.\nStep back to when you only tried 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Best difference is negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return best · k as it is', 'next' => 'wrong_b'],
                ['label' => 'Return its non-negative residue mod 10^9 + 7', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → −2 instead of 1000000005.\nStep back to when you skipped the residue.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · √V + n · P). Examples → 36, 6, 1000000005.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
