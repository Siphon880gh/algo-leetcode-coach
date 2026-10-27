Given an array of stock prices by day, choose days so that between any two consecutive chosen days the price changes by exactly the number of days between them. The score is the sum of the chosen prices; return the largest score. Indexing and limits are in the official statement. For instance, [1, 5, 3, 7, 8] → 20 and [5, 6, 7, 8, 9] → 35. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Group key

1. For each i: `sum[price[i] − i] += price[i]`.
2. Return the largest sum.

Constructed checks (run in code): the examples above; [4, 1, 9, 2] → 9; 400 random arrays match testing every subset. The key works with 0- or 1-based days.

Taking only the single largest price gives 8 instead of 20 in the first example.

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
