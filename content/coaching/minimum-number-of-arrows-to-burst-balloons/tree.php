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
                ['label' => 'Sort by end, shoot at the end of the first balloon not yet burst', 'next' => 's2'],
                ['label' => 'Sort by start and shoot at each start', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting by start and shooting at starts can waste arrows: an early long balloon does not tell you where the short ones end.\nStep back to when you sorted by start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "last = −infinity. Walk balloons by end.\nWhen do you need a new arrow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When x_start >= last', 'next' => 'wrong_b'],
                ['label' => 'When x_start > last; then last = x_end and count it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ends are inclusive. [1,2] and [2,3] share an arrow at 2, so a start equal to last is already burst.\nStep back to when you used >=.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shooting at the earliest end hits that balloon and as many later ones as possible. O(n log n). Non-overlapping Intervals (435) uses the same sort. Compare with a comparator, not subtraction, to avoid overflow.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort by end with a safe comparator; shoot when start > last', 'next' => 'success'],
                ['label' => 'Sort with comparator (a, b) → a[1] − b[1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. a − b can overflow when values are near ±2^31, which breaks the sort.\nStep back to when you sorted with subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort by end, shoot when a balloon starts after the last arrow. [[10,16],[2,8],[1,6],[7,12]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
