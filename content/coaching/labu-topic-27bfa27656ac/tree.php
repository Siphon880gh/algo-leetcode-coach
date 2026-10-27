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
            'message' => "State:\ncheck whether \"abba\" is a palindrome\n\nWhich tool fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pointers moving in from both ends', 'next' => 'mid'],
                ['label' => 'Sort the string first', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nSorting destroys the order you need. Compare letters from both ends, moving inward.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou add n chunks to an immutable string with +=\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) time spent copying', 'next' => 'final'],
                ['label' => 'None, because it is always O(n)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nWith immutable strings, each += may copy the whole string so far.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nfind the longest substring with at most 2 distinct letters\n\nWhich pattern fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A sliding window with letter counts', 'next' => 'success'],
                ['label' => 'Only an edit distance table', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nA window that tracks letter counts solves this in one pass.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Two pointers, sliding windows and string builders cover most string problems.\n- Watch the cost of repeated concatenation.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
