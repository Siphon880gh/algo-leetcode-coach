## Two candidates

1. Find the first `i` with `nums[i] ≤ nums[i − 1]`; none → true.
2. Return whether removing index `i − 1` or index `i` yields a strictly increasing array.

`[1,2,10,5,7]` → true. `[2,3,1,2]` → false. `[1,1,1]` → false. Checked against removing every index on random arrays.

Removing anything else leaves the pair `(i − 1, i)` in place. A single O(n) pass with a counter also works but has subtle cases; checking two arrays is simple for n ≤ 1000.

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
