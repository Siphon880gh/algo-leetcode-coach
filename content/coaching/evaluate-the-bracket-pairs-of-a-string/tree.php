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
            'message' => "Read the problem statement above.\nLookup structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash map from key to value', 'next' => 's2'],
                ['label' => 'Scan knowledge each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(|knowledge|) per bracket.\nStep back to when you scanned the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Unknown key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the bracket text', 'next' => 'wrong_b'],
                ['label' => 'Append "?"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement replaces unknown keys with a question mark.\nStep back to when you kept the text.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Replace with str.replace per key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, one left-to-right scan', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is slow and could alter letters outside brackets.\nStep back to when you used replace.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + knowledge). Examples → bobistwoyearsold, hi?, yesyesyesaaa.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
