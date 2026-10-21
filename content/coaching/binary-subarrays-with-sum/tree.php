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
            'message' => "Read the problem statement above.\nOne sliding window for \"exactly goal\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: zeros make the boundaries ambiguous; use prefix counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A window can be extended over zeros in several ways.\nStep back to when you used one window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you add at each index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count[s + goal]', 'next' => 'wrong_b'],
                ['label' => 'count[s − goal]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need an earlier prefix that is goal smaller.\nStep back to when you added goal.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Initial state of the map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count[0] = 1', 'next' => 'success'],
                ['label' => 'Empty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Subarrays starting at index 0 need the empty prefix.\nStep back to when you started empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,1,0,1], goal 2 → 4. [0,0,0,0,0], goal 0 → 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
