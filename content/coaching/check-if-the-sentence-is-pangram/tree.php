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
                ['label' => 'A set or 26-bit mask', 'next' => 's2'],
                ['label' => 'Sort the string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting is unnecessary work.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length ≥ 26', 'next' => 'wrong_b'],
                ['label' => 'All 26 letters present', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A long string can repeat letters.\nStep back to when you checked the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Early exit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Possible once 26 are seen', 'next' => 'success'],
                ['label' => 'Never possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is fixed once all letters appear.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
