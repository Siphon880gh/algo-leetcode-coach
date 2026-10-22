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
            'message' => "Read the problem statement above.\nn reaches 5 · 10^4. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted window plus binary trie', 'next' => 's2'],
                ['label' => 'Every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 1.25 · 10^9 pairs.\nStep back to when you tested every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Trie holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every value up to y', 'next' => 'wrong_b'],
                ['label' => 'Values x with 2x ≥ y', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Small values are not strong partners; examples 2 and 3 → 110 and 3020 instead of 0 and 1020.\nStep back to when you kept every smaller value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 7, 0, 1020.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
