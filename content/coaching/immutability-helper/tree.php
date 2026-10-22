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
            'message' => "Problem: A class is built from a JSON object and has a method, produce, that takes a mutator function. produce passes the mutator a proxy of the object; the mutator may appear to change it, including nested values, and produce returns a new object with those changes applied while the original stays untouched. Which operations the mutator may use, and any efficiency requirements, are in the official statement. For instance, starting from an object with x = 5, a mutator that sets x to x + 1 produces an object with x = 6 and leaves the original at 5. (Restated from memory; limits and examples may differ slightly.)\nThe mutator assigns a value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record it by path', 'next' => 's2'],
                ['label' => 'Write it to the original', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The original must stay as it was; in Node setting x = x + 1 leaves the original at 6 instead of 5.\nStep back to when you wrote through.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A read after a recorded write?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Read the original', 'next' => 'wrong_b'],
                ['label' => 'Return the recorded value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The mutator sees stale data; in Node x = x + 1 twice records 6 instead of 7.\nStep back to when you read the original.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(changes · depth) to rebuild. Constructed checks (run in Node) → new x = 6, original x = 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
