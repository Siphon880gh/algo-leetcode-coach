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
            'message' => "Read the problem statement above.\nWhich removals fail?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those whose remaining elements still OR to the full value', 'next' => 's2'],
                ['label' => 'Only the empty removal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 7 instead of 3.\nStep back to when you counted every non-empty removal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count kept sets with OR = full?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^cnt[full] directly', 'next' => 'wrong_b'],
                ['label' => 'Inclusion–exclusion over submasks', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 0 instead of 3 (that counts every set inside full).\nStep back to when you skipped the exclusion.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + B · 2^B). Examples → 3, 4, 1, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
