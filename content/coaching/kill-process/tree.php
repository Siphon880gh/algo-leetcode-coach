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
            'message' => "Problem: pid[i] is a process and ppid[i] its parent (0 for the root); together they form one tree. Killing a process kills all its descendants. Return every pid that dies when you kill kill. pid = [1,3,10,5], ppid = [3,0,5,3], kill = 5 → [5,10]. (Restated from memory; limits and examples may differ slightly.)\nScan ppid for the children of every killed pid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build a parent → children map once', 'next' => 's2'],
                ['label' => 'Yes: rescan both lists for each pid', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rescanning is O(n²) on a long chain.\nStep back to when you rescanned the lists.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find everything that dies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk up the parents from kill', 'next' => 'wrong_b'],
                ['label' => 'BFS or DFS from kill over the children map', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Parents survive; only descendants die.\nStep back to when you walked upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is kill itself in the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: it is the first process to die', 'next' => 'success'],
                ['label' => 'No: only its descendants', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The process you kill is killed too.\nStep back to when you left out kill.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Children map plus BFS/DFS from kill: O(n) time and space. → [5,10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
