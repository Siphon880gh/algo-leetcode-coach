There are n elements, numbered 0 to n − 1, and each belongs to some category. You cannot see the categories; you can only ask a provided object whether two elements are in the same category. Return the number of distinct categories. The method name and limits are in the official statement. For instance, if the hidden categories are [1, 1, 2, 3, 2], the answer is 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## First members

1. `count = 0`.
2. For each i: if no j < i shares i’s category (one query per j), `count += 1`.
3. Return count.

Constructed checks (run in code): the example above → 3; 400 random hidden category lists give the number of distinct values.

Comparing each element only with the one before it counts changes, not categories: hidden [1, 2, 1] → 3 instead of 2. Asking only against one representative per category found so far cuts the queries but keeps O(n²) in the worst case.

Time: O(n²) queries  
Space: O(1)

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
