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
            'message' => "Problem: Given an object or array and a predicate, return a copy that keeps only the values passing the predicate, at every depth, and drops objects and arrays that end up empty. What to return when nothing is left is in the official statement. For instance, with the predicate x > 0, {a: 1, b: {c: 2, d: −1}, e: [−3, 4]} becomes {a: 1, b: {c: 2}, e: [4]}. (Restated from memory; limits and examples may differ slightly.)\nTest whether an object is empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After filtering its children', 'next' => 's2'],
                ['label' => 'Before filtering', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Emptied branches stay; in Node {a: {b: −1}, c: 1} → {a: {}, c: 1}.\nStep back to when you tested first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "null is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An object, since typeof says so', 'next' => 'wrong_b'],
                ['label' => 'A leaf', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reading its entries throws; in Node that gave a TypeError.\nStep back to when you treated null as an object.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(size). In Node {a: {b: −1}, c: 1} → {c: 1}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
