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
            'message' => "Problem: Write your own version of JSON.stringify for values that came from JSON.parse: strings, numbers, booleans, null, arrays and plain objects, nested to any depth, without calling JSON.stringify. The output format, such as spacing and key order, is described in the official statement. For instance, an object with y = 1 and x = the string a becomes `{\"y\":1,\"x\":\"a\"}`, the same text JSON.stringify gives, and an array of 1, the string b, null and true becomes `[1,\"b\",null,true]`. (Restated from memory; limits and examples may differ slightly.)\nFirst check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'v === null', 'next' => 's2'],
                ['label' => 'typeof v is object', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. typeof null is object too; in Node null → a TypeError from Object.keys instead of null.\nStep back to when you checked objects first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A string value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Output it as is', 'next' => 'wrong_b'],
                ['label' => 'Wrap it in double quotes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. JSON strings are quoted; [1, b] with b a string → [1,b] with b unquoted instead of quoted.\nStep back to when you dropped the quotes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(output length). Constructed checks (run in Node) → match JSON.stringify.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
