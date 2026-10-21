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
                ['label' => 'Sort by start; keep each interval that does not overlap the last kept one', 'next' => 'wrong_a'],
                ['label' => 'Sort by end; greedily keep the interval that finishes first', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting by start and keeping the first can keep a long interval that blocks many short ones. [[1,10],[2,3],[4,5]] keeps [1,10] and removes two, but removing only [1,10] is best.\nStep back to when you sorted by start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sorted by end. prev = −infinity.\nWhen do you keep the next interval?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When start >= prev; then prev = its end. Otherwise count a removal', 'next' => 's3'],
                ['label' => 'Only when start > prev', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Touching endpoints do not overlap in this problem. Treating start == prev as overlap removes [2,3] after [1,2] for no reason.\nStep back to when you used a strict comparison.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Earliest finish leaves the most room, so it maximizes kept intervals (activity selection). Answer = n − kept. O(n log n) time. Merge Intervals (56) unions; Minimum Arrows (452) uses the same sort but counts arrows.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort by end, keep if start >= prev, return n − kept. Not 56 / 452', 'next' => 'success'],
                ['label' => 'Return how many intervals you kept', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Removals are n minus kept intervals, not the number of kept ones.\nStep back to when you returned the keep count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort by end, keep when start >= last kept end, answer is n − kept. [[1,2],[2,3],[3,4],[1,3]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
