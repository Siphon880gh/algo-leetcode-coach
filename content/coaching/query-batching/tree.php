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
            'message' => "Problem: Build a batcher around an async function that takes an array of keys and resolves with an array of values in the same order. Callers ask for one key at a time and get a promise for its value; the batcher groups requests that arrive close together into a single call, throttled by a time window. The class and method names, the exact throttle rule, and how errors are reported are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nClear the queue when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before calling the function', 'next' => 's2'],
                ['label' => 'After it returns', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Requests made during the call are lost; in Node one resolves with undefined instead of b!.\nStep back to when you cleared late.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Send keys how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One call per request', 'next' => 'wrong_b'],
                ['label' => 'All queued keys in one call', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is no batching; the four requests → 4 calls instead of 2.\nStep back to when you called per request.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per request besides the calls. The check → a!, b!, c!, d! in two calls.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
