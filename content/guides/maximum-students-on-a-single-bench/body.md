Each record pairs a student id with a bench id. Return the largest number of different students on any one bench. A repeated record counts once, and with no records the answer is 0. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sets

1. bench → set of students.
2. Answer the largest set size, 0 if there are none.

Constructed checks (run in code): [[1, 5], [1, 5], [2, 5], [3, 6]] → 2; [] → 0.

Counting records instead of students: the first check → 3 instead of 2.

Time: O(n)  
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
