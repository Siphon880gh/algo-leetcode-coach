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
            'message' => "Problem: Design createPath(path, value), which creates a new path and returns true, or returns false if the path exists or its parent is missing, and get(path), which returns the value or −1. For instance, createPath(\"/a\", 1) is true and createPath(\"/c/d\", 1) is false when /c is missing. (Restated from memory; limits and examples may differ slightly.)\nPath already exists. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false, keep the old value', 'next' => 's2'],
                ['label' => 'Overwrite and return true', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Creating an existing path fails.\nStep back to when you overwrote.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Parent of \"/a/b\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"/": the root', 'next' => 'wrong_b'],
                ['label' => '"/a": text before the last slash', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The parent is the immediate prefix.\nStep back to when you used the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Parent is missing. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'success'],
                ['label' => 'Create the parent too', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Missing parents are not created.\nStep back to when you created them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(path)) per call. createPath(\"/a\", 1) → true, get(\"/a\") → 1, createPath(\"/c/d\", 1) → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
