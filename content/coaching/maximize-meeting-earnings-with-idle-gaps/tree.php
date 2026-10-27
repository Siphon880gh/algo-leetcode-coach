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
            'message' => "Read the problem statement above.\nExample 1: one meeting ends at 5, the next starts at 6. Total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8, the revenues plus the 1-unit gap', 'next' => 's2'],
                ['label' => '7, just the revenues', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The idle gap 6 − 5 pays 1 more, so the answer is 8.\nStep back to when you ignored idle pay.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extending a schedule that ends at e with meeting (s, end, v) adds how much?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'v + s − e, for any earlier meeting', 'next' => 'wrong_b'],
                ['label' => 'v + s − e, only when e ≤ s', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A schedule ending after s would overlap the new meeting, which is not allowed.\nStep back to when you allowed overlaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort by end, binary search, prefix max of value − end. O(n log n). Examples give 8, 12 and 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
