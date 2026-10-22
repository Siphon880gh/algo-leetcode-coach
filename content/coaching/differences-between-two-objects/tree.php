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
            'message' => "Problem: You get two deeply nested values parsed from JSON. Return an object that describes only what changed between them: for each key both contain, recurse when both values are objects or both are arrays, and report a changed value when they differ. The exact shape used to report a changed value, and how keys found in only one input and type changes are handled, are in the official statement. For instance, comparing {a: 1, b: {c: 2, d: 3}} with {a: 1, b: {c: 5, d: 3}}, the only change is at b.c. (Restated from memory; limits and examples may differ slightly.)\nBoth values are objects?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recurse over the shared keys', 'next' => 's2'],
                ['label' => 'Compare them with ===', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal objects are different references; in Node {c: 2} === {c: 2} → false, so unchanged objects look changed.\nStep back to when you compared references.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A value is null?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recurse, since typeof null is object', 'next' => 'wrong_b'],
                ['label' => 'Treat it as a plain value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. null has no keys; in Node Object.keys(null) → a TypeError.\nStep back to when you recursed into null.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total size). Constructed checks (run in Node) → b.c changed; x.1 changed; nothing for equal inputs.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
