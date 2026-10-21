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
            'message' => "Read the problem statement above.\nHeight update on a 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset to 0', 'next' => 's2'],
                ['label' => 'Keep the previous height', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A 0 breaks the vertical run.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why sort the row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To find the histogram stack order', 'next' => 'wrong_b'],
                ['label' => 'Columns can be rearranged freely', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No monotonic stack is needed; reordering puts the tallest columns together.\nStep back to when you used a stack.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Area for the i-th tallest (0-based)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'height[i] · (i + 1)', 'next' => 'success'],
                ['label' => 'height[i] · n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the i + 1 tallest columns reach that height.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log n). Examples → 4, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
