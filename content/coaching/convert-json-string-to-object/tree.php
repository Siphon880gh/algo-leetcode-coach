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
            'message' => "Problem: Given a valid JSON string, return the value it represents without using the built-in JSON.parse. Which features can appear in the input, such as whitespace or escapes, is in the official statement. For instance, {\"a\":[1,2,{\"b\":null}],\"c\":\"x\"} becomes an object with a: [1, 2, {b: null}] and c: \"x\". (Restated from memory; limits and examples may differ slightly.)\nOpening [ or {?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check for the closing bracket first', 'next' => 's2'],
                ['label' => 'Always read a first item', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Empty containers have none; in Node [] throws a SyntaxError.\nStep back to when you read an item at once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A backslash inside a string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop at the next quote', 'next' => 'wrong_b'],
                ['label' => 'Decode the escape', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An escaped quote then ends the string early; in Node a string holding one is cut short at it, keeping a stray backslash.\nStep back to when you ignored escapes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(length). The example and 500 random values match JSON.parse.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
