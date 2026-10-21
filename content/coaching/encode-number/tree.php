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
            'message' => "Problem: The statement defines a secret encoding of non-negative integers as binary strings through a table. Its pattern is: write num + 1 in binary and drop the leading 1, so 0 → \"\", 1 → \"0\", 2 → \"1\", 3 → \"00\". (Restated from memory; limits and examples may differ slightly.)\nConvert num directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: convert num + 1', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Lengths would be off by one.\nStep back to when you converted num.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After converting, then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the trailing bit', 'next' => 'wrong_b'],
                ['label' => 'Drop the leading 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The top bit only marks the length.\nStep back to when you dropped the last bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "num = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The empty string', 'next' => 'success'],
                ['label' => '"0"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 0 + 1 is 1, which leaves nothing after the top bit.\nStep back to when you returned the string 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log num). 23 → \"1000\". 107 → \"101100\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
