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
            'message' => "Read the problem statement above.\nLoop j in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k down to 0', 'next' => 's2'],
                ['label' => '0 up to k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. best[j − 1] then already counts this element: example 1 → 5 instead of 4.\nStep back to when you went upward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Best length before x with j − 1 changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan every earlier index', 'next' => 'wrong_b'],
                ['label' => 'best[j − 1] over all values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is about 1.3 · 10^9 steps at n = 5,000, k = 50.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n k). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
