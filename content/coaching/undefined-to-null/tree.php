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
            'message' => "Problem: Given an object or array, return a copy in which every undefined value, at any depth, is replaced with null. The exact input guarantees are in the official statement. For instance, {a: undefined, b: [1, undefined], c: {d: undefined}} becomes {a: null, b: [1, null], c: {d: null}}. (Restated from memory; limits and examples may differ slightly.)\nConvert with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A recursive map', 'next' => 's2'],
                ['label' => 'JSON.stringify and parse', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It drops undefined keys; in Node {a: undefined, b: [1, undefined]} → {b: [1, null]}.\nStep back to when you used JSON.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Recurse into v when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'typeof v is object', 'next' => 'wrong_b'],
                ['label' => 'v is an object and not null', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. typeof null is object; in Node {a: null} throws a TypeError.\nStep back to when you skipped the null check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(size). The example → {a: null, b: [1, null], c: {d: null}}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
