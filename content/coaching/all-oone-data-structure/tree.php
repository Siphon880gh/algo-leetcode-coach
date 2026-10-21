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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash map key → bucket; buckets in a doubly linked list sorted by count', 'next' => 's2'],
                ['label' => 'Hash map of counts plus a min-heap and a max-heap', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A heap gives O(log n) per update and needs lazy deletes; a scan for min and max is O(n). Neither meets O(1).\nStep back to when you chose a heap or a scan.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each bucket holds a count and a set of keys. Head side is the smallest count, tail side the largest.\ninc on a key at count c: what happens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk the list from the head until you find count c + 1', 'next' => 'wrong_b'],
                ['label' => 'Move it to the next bucket if that has count c + 1, else insert a new bucket right after', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Searching for the bucket with count c + 1 by walking the list is O(n). It can only be the very next bucket, or it does not exist yet.\nStep back to when you searched the list.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "dec mirrors inc toward the head, and a key at count 1 is removed from the map. Remove any bucket that becomes empty. getMinKey and getMaxKey read any key from the first and last bucket. LFU Cache (460) also groups by frequency but evicts.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Neighbor bucket moves, drop empty buckets, min = head, max = tail. Not 460', 'next' => 'success'],
                ['label' => 'Leave empty buckets in the list; they are harmless', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An empty bucket at the head or tail makes getMinKey or getMaxKey return nothing even though keys exist.\nStep back to when you kept empty buckets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Hash map to buckets, buckets in count order, moves only touch neighbors, empty buckets are removed. Every call is O(1).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
