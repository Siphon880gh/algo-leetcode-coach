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
            'message' => "Problem: Given an object, return a new object whose keys are the original values and whose values are the original keys. How repeated values are handled is in the official statement. For instance, {a: 1, b: 2} becomes {1: a, 2: b}. (Restated from memory; limits and examples may differ slightly.)\nA value is already a key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Collect the keys', 'next' => 's2'],
                ['label' => 'Overwrite it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Earlier keys are lost; in Node {a: 1, b: 2, c: 2} → {1: a, 2: c}.\nStep back to when you overwrote.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The entry is already an array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wrap again as [entry, key]', 'next' => 'wrong_b'],
                ['label' => 'Push the key', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Arrays nest; in Node {a: 2, b: 2, c: 2} → {2: [[a, b], c]} instead of {2: [a, b, c]}.\nStep back to when you wrapped again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). In Node {a: 1, b: 2, c: 2} → {1: a, 2: [b, c]}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
