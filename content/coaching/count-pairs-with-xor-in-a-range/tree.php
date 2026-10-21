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
            'message' => "Read the problem statement above.\nCount a range directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: f(high + 1) − f(low)', 'next' => 's2'],
                ['label' => 'Yes, walk both bounds at once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two prefix counts are simpler and less error-prone.\nStep back to when you walked both bounds.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Limit bit is 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go to node[xbit]', 'next' => 'wrong_b'],
                ['label' => 'Add count of node[xbit], go to node[xbit ^ 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matching x's bit makes the XOR bit 0, already below the limit.\nStep back to when you only followed one branch.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Insert x when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After querying it', 'next' => 'success'],
                ['label' => 'Before querying it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. x would pair with itself (XOR 0).\nStep back to when you inserted first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 15). Examples → 6, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
