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
            'message' => "State:\nmap has 15937 → Lin\nneed = name for 15937\n\nFast path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hash(15937) % capacity → bucket → match key → Lin', 'next' => 'coll'],
                ['label' => 'Scan every id in insertion order every time', 'next' => 'w_scan'],
            ],
        ],
        'w_scan' => [
            'message' => "Wrong.\n\nScanning works but is O(n). The hash table exists to avoid a full scan on average.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'coll' => [
            'message' => "State:\nbucket for 15937 also holds another id\n\nWhat do you do inside the bucket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare keys until 15937 matches (chain or probe)', 'next' => 'mut'],
                ['label' => 'Return the first value in the bucket without comparing keys', 'next' => 'w_first'],
            ],
        ],
        'w_first' => [
            'message' => "Wrong.\n\nColliding keys share a bucket. Equality on the key picks the right value.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'coll',
            'choices' => [],
        ],
        'mut' => [
            'message' => "State:\ncustom object used as key\nthen a hash/equals field is mutated\n\nWhat goes wrong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Later lookups hash to a different bucket and miss the entry', 'next' => 'success'],
                ['label' => 'Nothing — hash tables ignore key mutations', 'next' => 'w_mut'],
            ],
        ],
        'w_mut' => [
            'message' => "Wrong.\n\nThe table searches the new bucket and does not find the old entry.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mut',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Hash to a bucket for speed\n- Compare keys on collisions\n- Keep keys immutable\n\nExpected O(1) time, O(capacity) space.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
