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
            'message' => "Read the problem statement above.\ndeleteOne(x) when x is absent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Do nothing', 'next' => 's2'],
                ['label' => 'Decrement anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The count goes negative; deleteOne(5), add(5), hasFrequency(1) → false instead of true.\nStep back to when you decremented a missing number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "hasFrequency(f)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan every number’s count', 'next' => 'wrong_b'],
                ['label' => 'Read freq[f]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With 2 · 10^5 calls and up to 10^5 distinct numbers that is about 10^10 steps.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → [null,null,null,true], [null,null,null,false], [null,false,null,true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
