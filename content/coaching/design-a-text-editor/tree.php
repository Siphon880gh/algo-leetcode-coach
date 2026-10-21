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
            'message' => "Read the problem statement above.\nData structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two stacks, left and right of the cursor', 'next' => 's2'],
                ['label' => 'One string, inserting and deleting at the cursor', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each edit shifts the rest of the text; long texts make that O(length) per call.\nStep back to when you used one string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "deleteText(k) returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k', 'next' => 'wrong_b'],
                ['label' => 'min(k, characters left of the cursor)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. deleteText(10) in the example → 10 instead of 4.\nStep back to when you returned k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "cursorLeft and cursorRight return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last min(10, len) characters left of the cursor', 'next' => 'success'],
                ['label' => 'Characters right of the cursor', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. cursorRight(3) in the example → empty instead of etpractice.\nStep back to when you returned the right side.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k) per call. Example → null, null, 4, null, etpractice, leet, 4, empty, practi.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
