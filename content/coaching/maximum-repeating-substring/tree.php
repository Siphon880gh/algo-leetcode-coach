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
            'message' => "Read the problem statement above.\nCount occurrences instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: copies must be consecutive', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. abcab has two ab but no abab.\nStep back to when you counted occurrences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k reaches len(sequence)', 'next' => 'wrong_b'],
                ['label' => 'word · (k + 1) not in sequence', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Stop at the first missing repeat.\nStep back to when you looped on.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Tiny: lengths ≤ 100', 'next' => 'success'],
                ['label' => 'Needs KMP', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Brute force is fine at this size.\nStep back to when you reached for KMP.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
