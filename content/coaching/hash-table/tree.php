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
            'message' => "State:\nthe map holds 15937 mapped to Lin\nyou need the name for 15937\n\nWhat is the fast way?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compute hash(15937) % capacity, go to that bucket, match the key, and read Lin', 'next' => 'coll'],
                ['label' => 'Scan every ID in insertion order every time', 'next' => 'w_scan'],
            ],
        ],
        'w_scan' => [
            'message' => "Wrong.\n\nScanning works, but it is O(n). A hash table exists to avoid a full scan on average.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'coll' => [
            'message' => "State:\nthe bucket for 15937 also holds another ID\n\nWhat do you do inside the bucket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare keys until 15937 matches, along the chain or the probe sequence', 'next' => 'mut'],
                ['label' => 'Return the first value in the bucket without comparing keys', 'next' => 'w_first'],
            ],
        ],
        'w_first' => [
            'message' => "Wrong.\n\nColliding keys share a bucket. Comparing the keys picks the right value.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'coll',
            'choices' => [],
        ],
        'mut' => [
            'message' => "State:\na custom object is used as a key\nthen a field that the hash depends on is changed\n\nWhat goes wrong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Later lookups hash to a different bucket and miss the entry', 'next' => 'success'],
                ['label' => 'Nothing, because hash tables ignore changes to keys', 'next' => 'w_mut'],
            ],
        ],
        'w_mut' => [
            'message' => "Wrong.\n\nThe table searches the new bucket and never finds the old entry.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mut',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Hash the key to a bucket for speed.\n- Compare keys when buckets collide.\n- Keep keys unchangeable.\n\nIt takes expected O(1) time per operation and O(capacity) space.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
