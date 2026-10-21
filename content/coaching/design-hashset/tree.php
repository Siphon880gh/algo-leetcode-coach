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
            'message' => "Read the problem statement above.\nHow many buckets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A fixed prime such as 769', 'next' => 's2'],
                ['label' => 'One bucket per possible key', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is a valid boolean-array design, but it is not a hash table; buckets with hashing are the exercise.\nStep back to when you used one bucket per key.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "add(key) when key is already present. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append it again', 'next' => 'wrong_b'],
                ['label' => 'Do nothing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A duplicate would survive a later remove.\nStep back to when you appended again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "contains(key). Where do you look?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only in bucket key % B', 'next' => 'success'],
                ['label' => 'Every bucket', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The hash tells you the only bucket it can be in.\nStep back to when you scanned all buckets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) average per operation. add 1, add 2, contains 1 → true, contains 3 → false, add 2, contains 2 → true, remove 2, contains 2 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
