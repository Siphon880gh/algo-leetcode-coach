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
            'message' => "Read the problem statement above.\nWhat is the search state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A bitmask of which target positions are covered', 'next' => 's2'],
                ['label' => 'The multiset of stickers used so far', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Many sticker multisets reach the same coverage; the mask merges them.\nStep back to when you tracked stickers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which stickers do you try from a mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every sticker', 'next' => 'wrong_b'],
                ['label' => 'Only those containing the first uncovered letter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Some sticker must cover that letter, and order does not matter, so the others are redundant here.\nStep back to when you tried every sticker.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A target letter appears in no sticker. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return -1 immediately', 'next' => 'success'],
                ['label' => 'Search anyway; BFS will find it unreachable', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That works, but explores up to 2^t states for nothing.\nStep back to when you searched anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS over masks: O(2^t · S · t). [\"with\",\"example\",\"science\"], \"thehat\" → 3. [\"notice\",\"possible\"], \"basicbasic\" → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
