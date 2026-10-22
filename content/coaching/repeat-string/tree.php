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
            'message' => "Problem: Add a method to every string that returns the string repeated a given number of times, without using the built-in repeat. The method name and limits are in the official statement. For instance, hello repeated 2 times is hellohello, and code repeated 3 times is codecodecode. (Restated from memory; limits and examples may differ slightly.)\nAppend the block when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current bit of t is set', 'next' => 's2'],
                ['label' => 'Every step', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Extra copies creep in; in Node hello with 2 → 3 copies.\nStep back to when you always appended.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Double the block when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only after appending', 'next' => 'wrong_b'],
                ['label' => 'Every step', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The block falls behind the bits; in Node hello with 2 → hello.\nStep back to when you doubled only sometimes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(output length). The examples → hellohello, codecodecode.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
