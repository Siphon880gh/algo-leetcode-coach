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
            'message' => "Read the problem statement above.\nDo you need to sort on each set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: timestamps are strictly increasing', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The problem guarantees increasing timestamps.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "get(key, t) looks for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first timestamp ≥ t', 'next' => 'wrong_b'],
                ['label' => 'The last timestamp ≤ t', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A value set after t does not exist yet at time t.\nStep back to when you looked ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Every timestamp is larger than t. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '""', 'next' => 'success'],
                ['label' => 'The earliest value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing was set by time t.\nStep back to when you returned the earliest value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per get. set(\"foo\",\"bar\",1); get(\"foo\",1) → \"bar\"; get(\"foo\",3) → \"bar\"; set(\"foo\",\"bar2\",4); get(\"foo\",4) → \"bar2\"; get(\"foo\",5) → \"bar2\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
