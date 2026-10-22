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
            'message' => "Problem: Given an object or array produced by JSON.parse, return a version that cannot be changed at any depth: setting a key on an object, setting an index on an array, or calling an array method that mutates it must throw instead. The thrown value is a string, not an Error, and its exact wording, along with the list of mutating methods, is in the official statement. Reading values works as usual. For instance, after wrapping an object with x = 5, assigning x throws and x still reads 5. (Restated from memory; limits and examples may differ slightly.)\nNested objects?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wrap each one as it is read', 'next' => 's2'],
                ['label' => 'Wrap only the top level', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Inner values stay writable; in Node im.n.y = 2 succeeds instead of throwing.\nStep back to when you wrapped only the top.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Array methods such as push?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Let the set trap catch them', 'next' => 'wrong_b'],
                ['label' => 'Return a throwing function from get', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. push then fails on its index write; in Node it throws the index message instead of the method message.\nStep back to when you relied on set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per access. Constructed checks (run in Node) → every write and mutating call throws; reads work.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
