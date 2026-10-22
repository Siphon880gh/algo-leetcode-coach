Given an array, one operation adds the same integer (possibly negative) to every element of a prefix. Return the fewest operations that make all elements equal. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Adjacent differences

1. Answer = number of i with nums[i] ≠ nums[i + 1].

Constructed checks (run in code): [3, 3, 5, 1] → 2; [7] → 0. Checked against a breadth-first search over operations on 60 small arrays.

Counting distinct values minus 1: [1, 2, 1] → 1 instead of 2.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
