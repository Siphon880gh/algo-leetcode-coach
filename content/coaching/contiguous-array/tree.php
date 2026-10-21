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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map 0 → −1 and look for equal prefix sums', 'next' => 's2'],
                ['label' => 'Slide a window and check every length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A window cannot shrink or grow monotonically here; balance can return after going off. Every window is O(n²).\nStep back to when you checked every window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix s seen first at p.\nAt a later i with the same s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update first[s] = i', 'next' => 'wrong_b'],
                ['label' => 'ans = max(ans, i − p) and keep p (the first index)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Storing the latest index makes later gaps shorter.\nStep back to when you stored the latest index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Seed {0: −1} so balanced prefixes count. O(n) time.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '±1 prefix, first index map, seed {0: −1}', 'next' => 'success'],
                ['label' => 'Start with an empty map', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without the seed, [0,1] gives 0: the prefix after index 1 is 0, but 0 was never stored.\nStep back to when you started with an empty map.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Equal prefix sums with first indexes and a −1 seed. → 6 for example 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
