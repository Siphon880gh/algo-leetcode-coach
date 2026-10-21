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
            'message' => "Read the problem statement above.\nFind x how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map value → index', 'next' => 's2'],
                ['label' => 'Search the array each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With 10^5 values and 10^5 operations that is up to 10^10 steps.\nStep back to when you searched the array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After writing y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the map alone', 'next' => 'wrong_b'],
                ['label' => 'Store pos[y] = i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2’s last operation replaces 3, which only exists because of an earlier operation, so its index is unknown.\nStep back to when you skipped pos[y].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Operation order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As given', 'next' => 'success'],
                ['label' => 'Any order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In Example 2, 3 must be created before it can be replaced; reversed, the first operation finds no 3.\nStep back to when you reordered them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [3,2,7,1], [2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
