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
            'message' => "Read the problem statement above.\nm · n differs from the length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return an empty array', 'next' => 's2'],
                ['label' => 'Fill what fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All elements must be used exactly; otherwise it is impossible.\nStep back to when you filled partially.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Element k goes where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row k / m, column k % m', 'next' => 'wrong_b'],
                ['label' => 'Row k / n, column k % n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rows have n elements each.\nStep back to when you divided by m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "[1,2] with m = 1, n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[] because 1 · 1 ≠ 2', 'next' => 'success'],
                ['label' => '[[1]]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Dropping an element is not allowed; Example 3 → [].\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → [[1,2],[3,4]], [[1,2,3]], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
