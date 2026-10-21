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
                ['label' => 'Sort (start, original index) once, then binary search per end', 'next' => 's2'],
                ['label' => 'For each interval, scan all others for the smallest qualifying start', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning every start for every interval is O(n²), 4e8 checks at n = 2e4.\nStep back to when you scanned all starts per query.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sorted starts of the example: (1,2), (2,1), (3,0).\nFor end = 3, which pair do you want?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any pair with start >= 3, for example the last one', 'next' => 'wrong_b'],
                ['label' => 'The first pair with start >= 3 (lower bound): (3, 0) → index 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any start >= end is not enough; the right interval has the smallest such start. Picking the last one gives the wrong index.\nStep back to when you picked a non-leftmost match.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return the stored original index, or −1 when the lower bound is past the end. j == i is allowed, so [[1,1]] → [0]. O(n log n) time, O(n) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lower bound on sorted starts, return original index or −1. j may equal i', 'next' => 'success'],
                ['label' => 'Return the position in the sorted array', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting changes positions. The answer must be the original index, which is why you stored it with each start.\nStep back to when you returned the sorted position.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort starts with their indexes, lower-bound each end, report the original index or −1. [[3,4],[2,3],[1,2]] → [−1,0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
