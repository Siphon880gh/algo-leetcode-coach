This is the same task as Minimum Number of Coins for Fruits (buying fruit i lets you take the next i fruits free, and you may still buy a free fruit), with larger limits given in the official statement. Return the minimum coins to get every fruit. For instance, under those rules, [3, 1, 2] → 4 and [1, 10, 1, 1] → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sliding-window minimum (1-indexed)

This assumes the rules of part I.

1. For i = n down to 1: drop deque fronts with index > 2i + 1.
2. If 2i + 1 > n, the rest is free: f(i) = prices[i]. Otherwise `f(i) = prices[i] + f(front)`.
3. Pop back entries with f ≥ f(i); push i. Return f(1).

Constructed checks (run in code): the examples above; 1,500 random arrays match the O(n²) DP of part I.

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
