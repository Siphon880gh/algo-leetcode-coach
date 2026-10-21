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
            'message' => "Read the problem statement above.\nInitial count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[0] = 1 for the empty prefix', 'next' => 's2'],
                ['label' => 'All zeros', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Substrings starting at index 0 would be missed.\nStep back to when you left cnt[0] at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Masks to add per position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same mask only', 'next' => 'wrong_b'],
                ['label' => 'Same mask plus the 10 one-bit flips', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One odd letter is allowed.\nStep back to when you used only equal masks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Storage?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Array of 1024', 'next' => 'success'],
                ['label' => 'Map keyed by substring', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The mask fully describes parity.\nStep back to when you keyed by substring.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(10 · n). Examples → 4, 9, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
