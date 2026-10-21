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
            'message' => "Read the problem statement above.\nWhat is the real question?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The longest subarray with at most two distinct values', 'next' => 's2'],
                ['label' => 'The two most common fruits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The fruits must be picked from a contiguous run of trees.\nStep back to when you counted globally.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A third kind enters the window. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart the window at this tree', 'next' => 'wrong_b'],
                ['label' => 'Shrink from the left until only two kinds remain', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The kind just before this tree may extend back further.\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you know when a kind has left the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its count drops to 0; delete it from the map', 'next' => 'success'],
                ['label' => 'Track only the last two values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without counts you cannot tell when a kind is gone.\nStep back to when you dropped the counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,1] → 3. [0,1,2,2] → 3. [1,2,3,2,2] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
