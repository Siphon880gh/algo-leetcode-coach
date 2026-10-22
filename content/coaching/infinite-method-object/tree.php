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
            'message' => "Problem: Return an object on which calling any method, whatever its name, returns that method’s name as a string. The exact rules are in the official statement. For instance, obj.abc123() → abc123. (Restated from memory; limits and examples may differ slightly.)\nWhich method names to support?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any name, through a Proxy get trap', 'next' => 's2'],
                ['label' => 'A fixed list of methods', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Unknown names are missing; in Node obj.abc123() → a TypeError.\nStep back to when you listed methods.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The get trap returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The name itself', 'next' => 'wrong_b'],
                ['label' => 'A function that returns the name', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The caller calls the result; in Node calling a string → a TypeError.\nStep back to when you returned the name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Constructed checks (run in Node) → abc123, x.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
