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
            'message' => "Read the problem statement above.\nEvicted by the memory limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove it everywhere', 'next' => 's2'],
                ['label' => 'Only from the queue', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Router(2), add (1, 5, 100), (2, 5, 101), (3, 5, 102), getCount(5, 100, 102) → 3 instead of 2.\nStep back to when you kept its timestamp.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Forwarded packet, same triple again?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still a duplicate', 'next' => 'wrong_b'],
                ['label' => 'Not a duplicate any more', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Router(2): add (7, 4, 90), forward, add (7, 4, 90) → false instead of true.\nStep back to when you remembered it forever.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per call. Examples → [null, true, true, false, true, true, [2, 5, 90], true, 1], [null, true, [7, 4, 90], []].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
