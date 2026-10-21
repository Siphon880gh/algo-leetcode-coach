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
            'message' => "Read the problem statement above.\nDistinct means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Appears exactly once', 'next' => 's2'],
                ['label' => 'First occurrence of each string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In Example 1 the first occurrences are d, b, c, a, giving b for k = 2; the answer is a.\nStep back to when you used first occurrences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of the second pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted order', 'next' => 'wrong_b'],
                ['label' => 'The order of arr', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The k-th distinct string is counted in array order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fewer than k distinct strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the empty string', 'next' => 'success'],
                ['label' => 'Return the last distinct one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3 → empty string.\nStep back to when you returned the last one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → a, aaa, empty string.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
