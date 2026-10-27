## Greedy with regret

1. Sort the courses by `lastDay`.
2. Keep `time` (the total duration taken) and a max-heap of durations.
3. For each course `(d, last)`: push `d` and add it to `time`. If `time > last`, pop the largest duration and subtract it.

The heap size at the end is the answer.

Taking courses in deadline order is always feasible if any order is. When the newest course breaks its deadline, removing the longest course keeps the same count and frees the most time for later courses. Every course in the heap still finishes in time, because removing a course only moves the others earlier.

Do not sort by duration; deadlines decide the order. Do not skip a course that does not fit; it may replace a longer one already taken.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
