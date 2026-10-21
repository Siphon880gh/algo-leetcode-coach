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
                ['label' => 'One pass over nums2 with a stack, answers into a map', 'next' => 's2'],
                ['label' => 'For each x, find it and scan right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning right from each x is O(n × m). It passes, but the follow-up asks for O(n + m).\nStep back to when you scanned for each x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walk nums2. The stack holds values still waiting.\nWhat happens when y arrives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop just the top once, then push y', 'next' => 'wrong_b'],
                ['label' => 'While top < y: pop it, next[top] = y. Then push y', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Several waiting values can be smaller than y. In [3,1,4], the stack is [3,1] and 4 answers both.\nStep back to when you popped only one value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Values left on the stack get −1. Then answer = [next.get(x, −1) for x in nums1]. O(n + m). 503 wraps around; 739 stores distances.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Monotonic stack on nums2, then a map lookup. Not 503 / 739', 'next' => 'success'],
                ['label' => 'Run the stack over nums1 instead', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Next greater is defined by positions in nums2; nums1 is only the list of queries.\nStep back to when you used the nums1 order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Stack pass over nums2, map, look up nums1. → [−1,3,−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
