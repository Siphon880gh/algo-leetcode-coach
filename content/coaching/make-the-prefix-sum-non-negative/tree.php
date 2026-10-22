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
            'message' => "Problem: You get an integer array. In one move you take any element out and put it at the end of the array. Find the fewest moves that make every prefix sum non-negative. The exact limits and guarantees are in the official statement. For instance, [2,−3,−1,4] → 1 (move −3 to the end), and [3,−5,−4,6,2] → 2. (Restated from memory; limits and examples may differ slightly.)\nThe sum dips below 0. Move which element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most negative one seen so far', 'next' => 's2'],
                ['label' => 'The current element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An earlier, bigger drop may fix more; [5,−5,−3,−1,4] → 2 instead of 1.\nStep back to when you moved the current element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is the current element in the heap before the check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, push it afterwards', 'next' => 'wrong_b'],
                ['label' => 'Yes, push it first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The current drop may be the one to move; [−3,4] → 0 instead of 1.\nStep back to when you pushed late.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
