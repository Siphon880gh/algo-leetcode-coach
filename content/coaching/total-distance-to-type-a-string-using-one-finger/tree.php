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
            'message' => "Problem: The letter keys sit in the three usual QWERTY rows, each key at a (row, column) position. One finger starts on a fixed key and types the string s; moving from one key to the next costs the Manhattan distance between their positions. Return the total distance. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nFirst move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the starting key to s[0]', 'next' => 's2'],
                ['label' => 'None; start on s[0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): \"qa\" → 1 instead of 2.\nStep back to when you skipped the first move.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance between keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(|Δrow|, |Δcol|)', 'next' => 'wrong_b'],
                ['label' => '|Δrow| + |Δcol|', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"pz\" → 18 instead of 21.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 2, 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
