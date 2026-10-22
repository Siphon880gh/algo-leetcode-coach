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
            'message' => "Problem: Given a function fn and a time t in milliseconds, return a throttled version. The first call runs fn at once and starts a window of t ms. Calls during the window do not run fn; only the latest arguments are kept. When the window ends, if arguments were kept, fn runs with them and a new window starts; otherwise the next call runs at once again. The exact rules and examples are in the official statement. For instance, with t = 50 and calls at 0, 10 and 20 ms with inputs 1, 2 and 3, fn runs at 0 with 1 and at 50 with 3. (Restated from memory; limits and examples may differ slightly.)\nA call inside the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Save its arguments, replacing older ones', 'next' => 's2'],
                ['label' => 'Drop it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The last call must still run; t = 50 with calls at 0, 10, 20 → only the run at 0 instead of also running at 50 with 3.\nStep back to when you dropped calls.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the pending call runs at the window’s end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go idle', 'next' => 'wrong_b'],
                ['label' => 'Start a new window', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Runs would come closer than t; t = 50 with calls at 0, 10, 55 → runs at 0, 50, 55 instead of 0, 50, 100.\nStep back to when you went idle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Constructed checks (run in Node) → runs at 0 and 50; a later call runs at once.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
