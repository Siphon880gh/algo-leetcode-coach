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
            'message' => "Read the problem statement above.\nAdd what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two resolved numbers', 'next' => 's2'],
                ['label' => 'promise1 + promise2 directly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Promises are objects; in Node that gives the string [object Promise][object Promise].\nStep back to when you added the promises.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Wait how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Promise.race', 'next' => 'wrong_b'],
                ['label' => 'Promise.all, or await each', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. race settles with the first one only; in Node example 1 → 2 instead of 7.\nStep back to when you raced them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 7, −2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
