You are given a starting string and a target string. In one operation you may add or remove one character at either end of the starting string. Return the fewest operations that turn it into the target. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Keep the longest shared piece

This assumes only the starting string changes, one character per operation; check the official statement.

1. L = longest common substring: c[i][j] = c[i − 1][j − 1] + 1 when the characters match, else 0.
2. Return |s| + |t| − 2L.

Constructed checks (run in code): abcde → cdef: 3; ab → ba: 2; abc → xyz: 6. 150 random pairs match a breadth-first search over strings.

A subsequence is not enough, since the kept characters stay contiguous: abcb → acb with the longest common subsequence (3) gives 1; the answer is 3.

Time: O(|s| · |t|)  
Space: O(|t|)

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
