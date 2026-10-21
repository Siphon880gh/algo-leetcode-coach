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
            'message' => "Read the problem statement above.\nInitial mask index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'first[0] = −1', 'next' => 's2'],
                ['label' => 'first[0] = 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A prefix starting at index 0 needs −1.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check which masks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only m', 'next' => 'wrong_b'],
                ['label' => 'm and m ^ (1 << d)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One odd digit is allowed.\nStep back to when you checked only m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Store first or last occurrence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First', 'next' => 'success'],
                ['label' => 'Last', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Earliest gives the longest span.\nStep back to when you stored the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(10n). \"3242415\" → 5. \"12345678\" → 1. \"213123\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
