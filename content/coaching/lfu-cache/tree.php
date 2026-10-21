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
                ['label' => 'Key → node map, plus count → doubly linked list (most recent at the front)', 'next' => 's2'],
                ['label' => 'One min-heap ordered by (count, last use time)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A heap gives O(log n) per touch, and every touch changes a count, so it misses O(1).\nStep back to when you chose a heap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Touch a node at count f: remove it from list f, add it to the front of list f + 1.\nWhat about minFreq?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rescan every count list to find the minimum', 'next' => 'wrong_b'],
                ['label' => 'If list f is now empty and f == minFreq, minFreq += 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Scanning counts to find the new minimum is not O(1). minFreq only changes by one step on a touch.\nStep back to when you scanned for the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "put of a new key when full: remove the back node of list minFreq and its map entry. Insert the new node in list 1 and set minFreq = 1. put on an existing key updates the value and counts as a touch. LRU Cache (146) has one recency list.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Evict the back of list minFreq; new key sets minFreq = 1. Not 146', 'next' => 'success'],
                ['label' => 'Evict the front of list minFreq', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Evicting the front removes the most recently used of the tied keys. Ties go to the least recent, which sits at the back.\nStep back to when you evicted from the front.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count lists with recency order, minFreq moves by one on touches and resets to 1 on inserts, evict from the back of minFreq. Every call is O(1).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
