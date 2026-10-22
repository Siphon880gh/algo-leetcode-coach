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
            'message' => "Problem: You get two values that came from JSON.parse (numbers, strings, booleans, null, arrays and plain objects, nested to any depth). Decide whether they are deeply equal: the same primitive value, or arrays with equal elements in the same order, or objects with the same keys whose values are deeply equal. The exact rules and limits are in the official statement. For instance, {x: 1, y: [1,2]} and {y: [1,2], x: 1} → true; [1,2] and [2,1] → false; {a: 1} and {a: 1, b: null} → false. (Restated from memory; limits and examples may differ slightly.)\nBefore comparing keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check that both are arrays or both are not', 'next' => 's2'],
                ['label' => 'Go straight to the keys', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An array and an object can share keys; [1] and {0: 1} → true instead of false.\nStep back to when you skipped the array check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Key check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every key of a is in b', 'next' => 'wrong_b'],
                ['label' => 'Same key count, and every key of a is in b', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. b may have extra keys; {x: 1} and {x: 1, y: 2} → true instead of false.\nStep back to when you skipped the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total size). Constructed checks (run in Node) → as in the guide.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
